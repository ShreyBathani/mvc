<?php

namespace Block\Admin\ConfigGroup;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $configGroups = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/configGroup/grid.php');
    }

    public function setConfigGroups($configGroups = null){
        if (!$configGroups) {
            $configGroups = \Mage::getModel('Model\ConfigGroup')->fetchAll();
        }
        $this->configGroups = $configGroups;
        return $this;
    }

    public function getConfigGroups(){
        if (!$this->configGroups) {
            $this->setConfigGroups();
        }
        return $this->configGroups;
    }
}

?>