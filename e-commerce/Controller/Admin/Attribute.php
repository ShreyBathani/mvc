<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin
{

    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function formAction(){
        try{    
            $attributeId = (int) $this->getRequest()->getGet('attributeId');

            $attribute = \Mage::getModel('Model\Attribute');
            $attribute->load($attributeId);
            if($attributeId){
                if (!$attribute->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            //$tabBlock = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs')->toHtml();
            
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
        $editBlock = \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $attributeId = (int) $this->getRequest()->getGet('attributeId');

            $attribute = \Mage::getModel('Model\Attribute');
            $attribute->load($attributeId);
            if($attributeId){
                throw new \Exception("No record found.");
            }
            

            $attributeData = $this->getRequest()->getPost('attribute');
            $attributeData['backendModel'] = addslashes($attributeData['backendModel']);
            $attribute->setData($attributeData);
            if(!$attribute->save()){
                throw new \Exception("Error Processing Data.");
            }
            $query = "ALTER TABLE `{$attribute->entityTypeId}` ADD `{$attribute->code}` {$attribute->backendType}(45);";
            $attribute->getAdapter()->update($query);
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridBlock = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $attributeId = (int) $this->getRequest()->getGet('attributeId');
            if (!$attributeId) {
                throw new \Exception("Invalid Id.");
            }
            
            $attribute = \Mage::getModel('Model\Attribute');
            $attribute->load($attributeId);
            if (!$attribute->getOriginalData()) {
                throw new \Exception("No record found.");
            }
            $query = "ALTER TABLE `{$attribute->entityTypeId}` DROP COLUMN `{$attribute->code}`;";
            $attribute->getAdapter()->update($query);
            if(!$attribute->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>