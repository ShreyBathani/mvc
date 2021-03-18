<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Product extends \Controller\Core\Admin{

    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function formAction(){
        try {

            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getData()){
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
                if(!$product->getData()){
                    throw new \Exception("Reccord Not Found.");
                }
                $product->updatedDate = date("Y-m-d H:i:s");
            }
            else {
                $product->updatedDate = $product->createdDate = date("Y-m-d H:i:s");
            }

            $productData = $this->getRequest()->getPost('product');
            $product->setData($productData);

            if(!$product->save()){
                throw new \Exception("Error Processing Data.");
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
            if(!$product->getData()){
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