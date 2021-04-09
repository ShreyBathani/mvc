<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Customer extends Core\Table{
    
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    
    public function __construct(){
        $this->setTableName('customer');
        $this->setPrimaryKey('customerId');
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED => 'Enabled'
        ];
    }

    public function getBillingAddress()
    {
        $customerAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM {$customerAddress->getTableName()} WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'Billing';";
        if(!$customerAddress->fetchRow($query)){
            return false;
        }
        return $customerAddress;
    }

    public function getShippingAddress()
    {
        $customerAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM {$customerAddress->getTableName()} WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'Shipping';";
        if(!$customerAddress->fetchRow($query)){
            return false;
        }
        return $customerAddress;
    }
}

?>