<?php

namespace Controller\Admin;

class ConfigGroup extends \Controller\Core\Admin 
{
    public function gridAction()
    {
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function formAction(){
        try{  
            $groupId = (int) $this->getRequest()->getGet('groupId');

            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $configGroup->load($groupId);
            if($groupId){
                if (!$configGroup->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $editBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Edit')->setTableRow($configGroup)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $groupId = (int) $this->getRequest()->getGet('groupId');

            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $configGroup->load($groupId);
            if($groupId){
                if (!$configGroup->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $configGroup->createdDate = date("Y-m-d H:i:s");
            }
            $configGroupData = $this->getRequest()->getPost('configGroup');
            $configGroup->setData($configGroupData);
            if(!$configGroup->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $groupId = (int) $this->getRequest()->getGet('groupId');
            if (!$groupId) {
                throw new \Exception("Invalid Id.");
            }
            
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $configGroup->load($groupId);
            if (!$configGroup->getOriginalData()) {
                throw new \Exception("No record found.");
            }
            if(!$configGroup->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Group Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}


?>