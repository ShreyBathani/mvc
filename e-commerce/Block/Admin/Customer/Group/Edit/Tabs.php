<?php

namespace Block\Admin\Customer\Group\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('customerGroup', ['label' => 'Group Infomation', 'block' => 'Block\Admin\Customer\Group\Edit\Tabs\Form']);
        $this->setDefaultTab('customerGroup');
        return $this;
    }
}

?>