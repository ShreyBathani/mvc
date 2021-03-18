<?php

namespace Block\Admin\Admin\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('admin', ['label' => 'Admin Infomation', 'block' => 'Block\Admin\Admin\Edit\Tabs\Form']);
        $this->setDefaultTab('admin');
        return $this;
    }
}

?>