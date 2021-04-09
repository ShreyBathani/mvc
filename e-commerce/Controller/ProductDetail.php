<?php

namespace Controller;

\Mage::loadFileByClassName('Controller\Core\Customer');

class ProductDetail extends Core\Customer
{
    public function viewAction()
    {
        try{
            $productId = (int) $this->getRequest()->getGet('productId');
        
            $product = \Mage::getModel('Model\Product')->load($productId);
            if($productId){
                if (!$product->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            $viewBlock = \Mage::getBlock('Block\ProductDetail\view');
            $viewBlock->setProduct($product);
            $layout = $this->getLayout()->getContent()->addChild($viewBlock);
            $this->renderLayout();
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>