<?php

namespace Controller\Admin\Customer;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Group extends \Controller\Core\Admin{

    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function formAction(){
        try{
            $groupId = (int) $this->getRequest()->getGet('groupId');

            $customerGroup = \Mage::getModel('Model\Customer\Group');
            $customerGroup->load($groupId);
            if($groupId){
                if (!$customerGroup->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $editBlock = \Mage::getBlock('Block\Admin\Customer\Group\Edit')->setTableRow($customerGroup)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $groupId = (int) $this->getRequest()->getGet('groupId');

            $customerGroup = \Mage::getModel('Model\Customer\Group');
            $customerGroup->load($groupId);
            if($groupId){
                if (!$customerGroup->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $customerGroup->createdDate = date("Y-m-d H:i:s");
            }

            $customerGroupData = $this->getRequest()->getPost('customerGroup');
            $customerGroup->setData($customerGroupData);

            if(!$customerGroup->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        
        $gridBlock = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $groupId = (int) $this->getRequest()->getGet('groupId');
            if (!$groupId) {
                throw new \Exception("Invalid Id.");
            }

            $customerGroup = \Mage::getModel('Model\Customer\Group');
            $customerGroup->load($groupId);
            if (!$customerGroup->getOriginalData()) {
                throw new \Exception("No record found.");
            }
            if(!$customerGroup->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Customer\Group\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>