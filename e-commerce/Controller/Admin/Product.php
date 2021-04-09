<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Product extends \Controller\Core\Admin{

    public function gridAction(){
        try {
    		$filterModel = \Mage::getModel('Model\Admin\Filter')->unsetFilters();
            $gridBlock = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function filterAction()
	{
		$filters = $this->getRequest()->getPost('filters');
		$filterModel = \Mage::getModel('Model\Admin\Filter');
		$filterModel->setFilters($filters);
		$gridBlock = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($gridBlock);
	}

    public function formAction(){
        try {

            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getOriginalData()){
                    throw new \Exception("Reccord Not Found.");
                }
            }
            $editBlock = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->makeResponse($editBlock);
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getOriginalData()){
                    throw new \Exception("Reccord Not Found.");
                }
                $product->updatedDate = date("Y-m-d H:i:s");
            }
            else {
                $product->updatedDate = $product->createdDate = date("Y-m-d H:i:s");
            }

            $productData = $this->getRequest()->getPost('product');

            $categoryOptions = null;
            if (array_key_exists('category', $productData)) {
                $categoryOptions = $productData['category'];
                unset($productData['category']);
            }
            
            $product->setData($productData);
            
            if(!$product->save()){
                throw new \Exception("Error Processing Data.");
            }
            
            if ($categoryOptions) {
                $productId = $product->productId;
                $ids = '';
                foreach ($categoryOptions as $categoryId) {
                    $productCategory = \Mage::getModel('Model\Product\Category');
                    $query = "SELECT * FROM {$productCategory->getTableName()}
                    WHERE `productId` = '{$productId}' 
                    AND `categoryId` = '{$categoryId}';";
                    $exists = $productCategory->fetchRow($query);
                    $ids .= $categoryId.',';
                    if ($exists) {
                        continue;
                    }
                    $productCategory->productId = $productId;
                    $productCategory->categoryId = $categoryId;
                    $productCategory->save();
                }
                $ids = '('. rtrim($ids, ',').')';
                $productCategory = \Mage::getModel('Model\Product\Category');
                $query = "DELETE FROM `{$productCategory->getTableName()}` WHERE `productId` = '{$productId}' AND `categoryId` NOT IN {$ids};";
                $productCategory->getAdapter()->update($query);
            }

            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $productId = (int) $this->getRequest()->getGet('productId');
            if (!$productId) {
                throw new \Exception("Invalid Id.");
            }

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if(!$product->getOriginalData()){
                throw new \Exception("No record Found.");
            }

            if(!$product->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        
        $gridBlock = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>