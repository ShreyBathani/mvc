<?php

namespace Block\Admin\Customer\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTab()
    {
        $this->addTab('customer', ['label' => 'Customer Information', 'block' => 'Block\Admin\Customer\Edit\Tabs\Form']);
        if ($this->getRequest()->getGet('customerId')) {
            $this->addTab('address', ['label' => 'Address', 'block' => 'Block\Admin\Customer\Edit\Tabs\Address']);
        }
        $this->setDefaultTab('customer');
        return $this;
    }
}

?>