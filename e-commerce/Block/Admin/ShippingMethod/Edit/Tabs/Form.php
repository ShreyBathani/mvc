<?php

namespace Block\Admin\ShippingMethod\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\ShippingMethod\Edit');

Class Form extends \Block\Admin\ShippingMethod\Edit
{
    //protected $shippingMethod = null;
    
    public function __construct() {
        $this->setTemplate('View/admin/shippingmethod/edit/tabs/form.php');
    }

    /* public function setShippingMethod($shippingMethod = null){
        if ($shippingMethod) {
            $this->$shippingMethod = $shippingMethod;
            return $this;
        }
        $shippingMethod = \Mage::getModel('Model\ShippingMethod');
        if($id = $this->getRequest()->getGet('methodId')){
            $shippingMethod = $shippingMethod->load($id);
        }
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getShippingMethod(){
        if (!$this->shippingMethod) {
            $this->setShippingMethod();
        }
        return $this->shippingMethod;
    } */
}

?>