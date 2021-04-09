<?php

namespace Block\Admin\Cms\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('cms', ['label' => 'Cms Information', 'block' => 'Block\Admin\Cms\Edit\Tabs\Form']);
        $this->setDefaultTab('cms');
        return $this;
    }
}

?>