<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class GroupPrice extends \Controller\Core\Admin
{
    public function gridAction(){
        try {
            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getOriginalData()){
                    throw new \Exception("Record Not Found.");
                }
            }
            
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $formBlock = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();
        $this->makeResponse($formBlock);
    }
    
    public function saveAction()
    {   
        try {
            
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }

            $productId = (int) $this->getRequest()->getGet('productId');
            if (!$productId) {
                throw new \Exception("Invalid Id.");
            }
            
            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if(!$product->getOriginalData()){
                throw new \Exception("No Product Found.");
            }
            
            $GroupData = $this->getRequest()->getPost("groupPrice");
            
            if(array_key_exists('exists', $GroupData)){
                foreach ($GroupData['exists'] as $groupId => $price) {
                    $query = "SELECT * FROM product_group_price 
                    WHERE `productId` = '{$productId}' 
                    AND `customerGroupId` = '{$groupId}';";
                    $groupPrice = \Mage::getModel('Model\Product\GroupPrice');
                    $groupPrice->fetchRow($query);
                    $groupPrice->price = $price;
                    $groupPrice->save();
                }
            }
            
            if(array_key_exists('new', $GroupData)){
                foreach ($GroupData['new'] as $groupId => $price) {
                    $groupPrice = \Mage::getModel('Model\Product\GroupPrice');
                    $groupPrice->customerGroupId = $groupId;
                    $groupPrice->productId = $productId;
                    $groupPrice->price = $price;
                    $groupPrice->save();
                }
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}

?>