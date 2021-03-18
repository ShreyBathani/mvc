<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin
{
    public function gridAction(){
        try {
            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getData()){
                    throw new \Exception("Record Not Found.");
                }
            }
            $formBlock = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
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
            if(!$product->getData()){
                throw new \Exception("No Product Found.");
            }

            $productData = $this->getRequest()->getPost('product');
            
            foreach ($productData as $key => $value) {
                if (gettype($value) != 'array') {
                    $product->$key = $value;
                }
                else{
                    $value = implode(',', $value);
                    $product->$key = $value;
                }
            }
            if(!$product->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}