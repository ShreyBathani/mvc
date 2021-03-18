<?php

namespace Block\Admin\PaymentMethod\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\PaymentMethod\Edit');

Class Form extends \Block\Admin\PaymentMethod\Edit
{
    //protected $paymentMethod = null;
    
    public function __construct() {
        $this->setTemplate('View/admin/paymentmethod/edit/tabs/form.php');
    }

    /* public function setPaymentMethod($paymentMethod = null){
        if ($paymentMethod) {
            $this->$paymentMethod = $paymentMethod;
            return $this;
        }
        $paymentMethod = \Mage::getModel('Model\PaymentMethod');
        if($id = $this->getRequest()->getGet('methodId')){
            $paymentMethod = $paymentMethod->load($id);
        }
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getPaymentMethod(){
        if (!$this->paymentMethod) {
            $this->setPaymentMethod();
        }
        return $this->paymentMethod;
    } */
}

?>