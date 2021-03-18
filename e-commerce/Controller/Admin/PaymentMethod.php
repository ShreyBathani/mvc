<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class PaymentMethod extends \Controller\Core\Admin{
    
    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function formAction(){
        try{
            $methodId = (int) $this->getRequest()->getGet('methodId');

            $paymentMethod = \Mage::getModel('Model\PaymentMethod');
            $paymentMethod->load($methodId);
            if($methodId){
                if (!$paymentMethod->getData()) {
                    throw new \Exception("No record found.");
                }
            }

            $editBlock = \Mage::getBlock('Block\Admin\PaymentMethod\Edit')->setTableRow($paymentMethod)->toHtml();
            //$tabBlock = \Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs')->toHtml();
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->makeResponse($editBlock);
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $methodId = (int) $this->getRequest()->getGet('methodId');

            $paymentMethod = \Mage::getModel('Model\PaymentMethod');
            $paymentMethod->load($methodId);
            if($methodId){
                if (!$paymentMethod->getData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $paymentMethod->createdDate = date("Y-m-d H:i:s");
            }
            $paymentMethodData = $this->getRequest()->getPost('paymentMethod');
            $paymentMethod->setData($paymentMethodData);
            if(!$paymentMethod->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $methodId = (int) $this->getRequest()->getGet('methodId');
            if (!$methodId) {
                throw new \Exception("Invalid Id.");
            }

            $paymentMethod = \Mage::getModel('Model\PaymentMethod');
            $paymentMethod->load($methodId);
            if(!$paymentMethod->getData()){
                throw new \Exception("No record Found.");
            }
            if(!$paymentMethod->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>