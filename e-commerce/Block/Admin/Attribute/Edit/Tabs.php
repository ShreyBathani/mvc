<?php

namespace Block\Admin\Attribute\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {   
        parent::prepareTab();
        $this->addTab('attribute', ['label' => 'Attribute Infomation', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        if ($this->getRequest()->getGet('attributeId')) {
            $this->addTab('option', ['label' => 'Attribute Option', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Option']);
        }
        $this->setDefaultTab('attribute');
        return $this;
    }
}

?>