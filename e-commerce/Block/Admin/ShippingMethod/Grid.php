<?php

namespace Block\Admin\ShippingMethod;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $shippingMethods = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/shippingmethod/grid.php');
    }

    public function setShippingMethods($shippingMethods = null){
        if (!$shippingMethods) {
            $shippingMethod = \Mage::getModel('Model\ShippingMethod');
            $shippingMethods = $shippingMethod->fetchAll();
        }
        $this->shippingMethods = $shippingMethods;
        return $this;
    }

    public function getShippingMethods(){
        if (!$this->shippingMethods) {
            $this->setShippingMethods();
        }
        return $this->shippingMethods;
    }
}

?>