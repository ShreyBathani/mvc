<?php

namespace Block\Admin\ShippingMethod\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('shippingMethod', ['label' => 'Shipping Method', 'block' => 'Block\Admin\ShippingMethod\Edit\Tabs\Form']);
        $this->setDefaultTab('shippingMethod');
        return $this;
    }
}

?>