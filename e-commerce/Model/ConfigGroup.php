<?php

namespace Model;

class ConfigGroup extends Core\Table
{
    public function __construct() {
        $this->setTableName('config_group');
        $this->setPrimaryKey('groupId');
    }

    public function getConfigurations()
    {   
        if (!$this->groupId) {
            return false;
        }
        $configurations = \Mage::getModel('Model\ConfigGroup\Configuration');
        $query = "SELECT * FROM {$configurations->getTableName()} 
        WHERE `{$this->getPrimaryKey()}` = {$this->groupId};";  
        return $configurations->fetchAll($query);
    }
}

?>