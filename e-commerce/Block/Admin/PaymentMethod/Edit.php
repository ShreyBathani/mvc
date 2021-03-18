<?php

namespace Block\Admin\PaymentMethod;

\Mage::loadFileByClassName('Block\Core\Edit');

Class Edit extends \Block\Core\Edit{
    
    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs'));
        //$this->setTemplate('View/admin/paymentmethod/edit.php');
    }

    /* public function getTabContent()
    {
        $tabBlock =  \Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
        if (!array_key_exists($tab, $tabs)) {
            return null;
        }
        $tabBlock = $tabs[$tab]['block'];
        echo \Mage::getBlock($tabBlock)->toHtml();
    } */
}

?>