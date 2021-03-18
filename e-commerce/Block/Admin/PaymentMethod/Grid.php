<?php

namespace Block\Admin\PaymentMethod;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $paymentMethods = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/paymentmethod/grid.php');
    }

    public function setPaymentMethods($paymentMethods = null){
        if (!$paymentMethods) {
            $paymentMethod = \Mage::getModel('Model\PaymentMethod');
            $paymentMethods = $paymentMethod->fetchAll();
        }
        $this->paymentMethods = $paymentMethods;
        return $this;
    }

    public function getPaymentMethods(){
        if (!$this->paymentMethods) {
            $this->setPaymentMethods();
        }
        return $this->paymentMethods;
    }
}

?>
