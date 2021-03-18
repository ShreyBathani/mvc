<?php

namespace Block\Admin\PaymentMethod\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{

    /* public function __construct()
    {   
        $this->setTemplate('View/admin/paymentmethod/edit/tabs.php');
        $this->prepareTab();
    } */
    
    public function prepareTab()
    {
        $this->addTab('paymentMethod', ['label' => 'Payment Method', 'block' => 'Block\Admin\PaymentMethod\Edit\Tabs\Form']);
        $this->setDefaultTab('paymentMethod');
        return $this;
    }
}

?>