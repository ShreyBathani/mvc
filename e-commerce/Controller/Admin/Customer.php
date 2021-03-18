<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Customer extends \Controller\Core\Admin{

    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $this->makeResponse($gridBlock);

            /* $layout = $this->getLayout();
            $content = $layout->getContent();
            $content->addChild($gridBlock);
            $this->renderLayout(); */
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function formAction(){
        try {
            $customerId = (int) $this->getRequest()->getGet('customerId');

            $customer = \Mage::getModel('Model\Customer');
            $customer->load($customerId);
            if ($customerId) {
                if(!$customer->getData()){
                    throw new \Exception("No record found.");
                }
            }
            $editBlock = \Mage::getBlock('Block\Admin\Customer\Edit')->setTableRow($customer)->toHtml();

            /* $layout = $this->getLayout();
            $layout->setTemplate('View/admin/core/layout/twoColumn.php');
            
            $content = $layout->getContent();
            $content->addChild($editBlock);

            $left = $layout->getLeft();
            $left->addChild($tabBlock);
            
            $this->renderLayout(); */
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

            $customerId = (int) $this->getRequest()->getGet('customerId');
            $customer = \Mage::getModel('Model\Customer');
            $customer->load($customerId);
            if ($customerId) {
                if(!$customer->getData()){
                    throw new \Exception("No record found.");
                }
                $customer->updatedDate = date("Y-m-d H:i:s");
            }
            else {
                $customer->updatedDate = $customer->createdDate = date("Y-m-d H:i:s");
            }
            
            $tab = $this->getRequest()->getGet('tab');
            if ($tab == 'address') {
                $addressBlock = \Mage::getBlock('Block\Admin\Customer\Edit\Tabs\Address')->setTableRow($customer);
                if(!$customerId){
                    throw new \Exception("No record found on this customer.");
                }

                $address = $addressBlock->getBilling();
                $billingData = $this->getRequest()->getPost('billing');
                $address->customerId = $customerId;
                $address->addressType = 'billing';
                $address->setData($billingData);
                if(!$address->save()){
                    throw new \Exception("Error Processing Billing Address.");
                }
                else{
                    $this->getMessage()->setSuccess('Address Stored Successfully !!');
                }
                
                $address->unsetData();
                $address = $addressBlock->getShipping();

                $shippingData = $this->getRequest()->getPost('shipping');
                $address->customerId = $customerId;
                $address->addressType = 'shipping';
                $address->setData($shippingData);
                if(!$address->save()){
                    throw new \Exception("Error Processing Shipping Address.");
                }
                else{
                    $this->getMessage()->setSuccess('Address Stored Successfully !!');
                }
            }
            else{
                $customerData = $this->getRequest()->getPost('customer');
                $customer->setData($customerData);
                if(!$customer->save()){
                    throw new \Exception("Error Processing Data.");
                }
                $this->getMessage()->setSuccess('Data Stored Successfully !!');
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($gridBlock);

        //$this->redirect('index', 'index', null, true);
    }

    public function deleteAction(){
        try{
            $customerId = (int) $this->getRequest()->getGet('customerId');
            if (!$customerId) {
                throw new \Exception("Invalid Id.");
            }

            $customer = \Mage::getModel('Model\Customer');
            $customer->load($customerId);
            if(!$customer->getData()){
                throw new \Exception("No record Found.");
            }
            if(!$customer->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        
        $gridBlock = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $this->makeResponse($gridBlock);

        //$this->redirect('grid', null, null, true);
    }
}

?>