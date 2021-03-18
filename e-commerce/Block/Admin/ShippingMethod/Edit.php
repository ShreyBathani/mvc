<?php

namespace Block\Admin\ShippingMethod;

\Mage::loadFileByClassName('Block\Core\Edit');

Class Edit extends \Block\Core\Edit{
    
    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\ShippingMethod\Edit\Tabs'));
        //$this->setTemplate('View/admin/shippingmethod/edit.php');
    }

    /* public function getTabContent()
    {
        $tabBlock =  \Mage::getBlock('Block\Admin\ShippingMethod\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
        if (!array_key_exists($tab, $tabs)) {
            return null;
        }
        $tabBlock = $tabs[$tab]['block'];
        echo \Mage::getBlock($tabBlock)->toHtml();
    }
    
    public function getFormUrl()
    {
        return $this->getUrl('save');
    } */
}

?>