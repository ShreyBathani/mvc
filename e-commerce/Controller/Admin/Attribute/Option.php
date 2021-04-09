<?php

namespace Controller\Admin\Attribute;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Option extends \Controller\Core\Admin{

    public function saveAction()
    {   
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }

            $attributeId = (int) $this->getRequest()->getGet('attributeId');
            if (!$attributeId) {
                throw new \Exception("Invalid Id.");
            }

            $attribute = \Mage::getModel('Model\Attribute');
            $attribute->load($attributeId);
            if(!$attribute->getOriginalData()){
                throw new \Exception("No Product Found.");
            }

            $existsData = $this->getRequest()->getPost('exists');
            $newData = $this->getRequest()->getPost('new');

            if(!$existsData){
                $option = \Mage::getModel('Model\Attribute\Option');
                $query = "DELETE FROM `{$option->getTableName()}` WHERE `attributeId` = '{$attributeId}';";
                $option->getAdapter()->update($query);
            }
            if($existsData){
                $ids = '';
                foreach ($existsData as $optionId => $data) {
                    $query = "SELECT * FROM attribute_option 
                    WHERE `attributeId` = '{$attributeId}' 
                    AND `optionId` = '{$optionId}';";
                    $option = \Mage::getModel('Model\Attribute\Option');
                    $option->fetchRow($query);
                    $option->name = $data['name'];
                    $option->sortOrder = $data['sortOrder'];
                    $option->save();
                    $ids .= $optionId.',';
                }
                $ids = '('. rtrim($ids, ',').')';
                $option = \Mage::getModel('Model\Attribute\Option');
                $query = "DELETE FROM `{$option->getTableName()}` WHERE `attributeId` = '{$attributeId}' AND `{$option->getPrimaryKey()}` NOT IN {$ids};";
                $option->getAdapter()->update($query);
            }
            
            if($newData){
                for ($i=0; $i < sizeof($newData['name']); $i++) {
                    $data = array_column($newData,$i);
                    $option = \Mage::getModel('Model\Attribute\Option');
                    $option->name = $data[0];
                    $option->sortOrder = $data[1];
                    $option->attributeId = $attributeId;
                    $option->save();
                }
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridBlock = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>