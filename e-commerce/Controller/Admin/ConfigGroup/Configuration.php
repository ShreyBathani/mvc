<?php

namespace Controller\Admin\ConfigGroup;

class Configuration extends \Controller\Core\Admin 
{
    public function saveAction()
    {
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }

            $groupId = (int) $this->getRequest()->getGet('groupId');
            if (!$groupId) {
                throw new \Exception("Invalid Id.");
            }

            $configGroup = \Mage::getModel('Model\ConfigGroup');
            $configGroup->load($groupId);
            if(!$configGroup->getOriginalData()){
                throw new \Exception("No Product Found.");
            }

            $existsData = $this->getRequest()->getPost('exists');
            $newData = $this->getRequest()->getPost('new');

            if(!$existsData){
                $configuration = \Mage::getModel('Model\ConfigGroup\Configuration');
                $query = "DELETE FROM `{$configuration->getTableName()}` WHERE `groupId` = '{$groupId}';";
                $configuration->getAdapter()->update($query);
            }
            if($existsData){
                $ids = '';
                foreach ($existsData as $configId => $data) {
                    $query = "SELECT * FROM config WHERE `groupId` = '{$groupId}' AND `configId` = '{$configId}';";
                    $configuration = \Mage::getModel('Model\ConfigGroup\Configuration');
                    $configuration->fetchRow($query);
                    $configuration->title = $data['title'];
                    $configuration->code = $data['code'];
                    $configuration->value = $data['value'];
                    $configuration->save();
                    $ids .= $configId.',';
                }
                $ids = '('. rtrim($ids, ',').')';
                $configuration = \Mage::getModel('Model\ConfigGroup\Configuration');
                $query = "DELETE FROM `{$configuration->getTableName()}` WHERE `groupId` = '{$groupId}' AND `{$configuration->getPrimaryKey()}` NOT IN {$ids};";
                $configuration->getAdapter()->update($query);
            }
            
            if($newData){
                for ($i=0; $i < sizeof($newData['title']); $i++) {
                    $data = array_column($newData,$i);
                    $configuration = \Mage::getModel('Model\ConfigGroup\Configuration');
                    $configuration->title = $data[0];
                    $configuration->code = $data[1];
                    $configuration->value = $data[2];
                    $configuration->groupId = $groupId;
                    $configuration->save();
                }
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $gridBlock = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}
?>