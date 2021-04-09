<?php

namespace Block\Admin\ConfigGroup\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\ConfigGroup\Edit');

Class Configuration extends \Block\Admin\ConfigGroup\Edit
{
    protected $configurations = null;

    public function __construct() {
        $this->setTemplate('View/admin/configGroup/edit/tabs/configuration.php');
    }

    public function setConfigurations($configurations = null){
        if ($configurations) {
            $this->$configurations = $configurations;
            return $this;
        }
        $groupId = $this->getTableRow()->groupId;
        $configGroup = \Mage::getModel('Model\ConfigGroup')->load($groupId);
        $this->configurations = $configGroup->getConfigurations();
        return $this;
    }

    public function getConfigurations(){
        if (!$this->configurations) {
            $this->setConfigurations();
        }
        return $this->configurations;
    }
}

?>