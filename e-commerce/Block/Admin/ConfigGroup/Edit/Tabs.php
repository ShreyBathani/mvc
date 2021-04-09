<?php

namespace Block\Admin\ConfigGroup\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('group', ['label' => 'Information', 'block' => 'Block\Admin\ConfigGroup\Edit\Tabs\Information']);
        $this->addTab('configuration', ['label' => 'Configuration', 'block' => 'Block\Admin\ConfigGroup\Edit\Tabs\Configuration']);
        $this->setDefaultTab('group');
        return $this;
    }
}

?>