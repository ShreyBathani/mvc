<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class ShippingMethod extends \Controller\Core\Admin{
    
    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function formAction(){
        try {
            $methodId = (int) $this->getRequest()->getGet('methodId');

            $shippingMethod = \Mage::getModel('Model\ShippingMethod');
            $shippingMethod->load($methodId);
            if($methodId){
                if (!$shippingMethod->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }

        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $editBlock = \Mage::getBlock('Block\Admin\ShippingMethod\Edit')->setTableRow($shippingMethod)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $methodId = (int) $this->getRequest()->getGet('methodId');

            $shippingMethod = \Mage::getModel('Model\ShippingMethod');
            $shippingMethod->load($methodId);
            if($methodId){
                if (!$shippingMethod->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $shippingMethod->createdDate = date("Y-m-d H:i:s");
            }

            $shippingMethodData = $this->getRequest()->getPost('shippingMethod');
            $shippingMethod->setData($shippingMethodData);

            if(!$shippingMethod->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }

        $gridBlock = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $methodId = (int) $this->getRequest()->getGet('methodId');
            if (!$methodId) {
                throw new \Exception("Invalid Id.");
            }

            $shippingMethod = \Mage::getModel('Model\ShippingMethod');
            $shippingMethod->load($methodId);
            if(!$shippingMethod->getOriginalData()){
                throw new \Exception("No record Found.");
            }

            if(!$shippingMethod->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>