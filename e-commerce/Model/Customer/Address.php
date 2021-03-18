<?php

namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Table');

class Address extends \Model\Core\Table{
    
    const TYPE_BILLING = 0;
    const TYPE_SHIPPING = 1;
    
    public function __construct(){
        $this->setTableName('customer_address');
        $this->setPrimaryKey('addressId');
    }
    
    public function getAddressTypeOption(){
        return [
            self::TYPE_BILLING => 'Billing',
            self::TYPE_SHIPPING => 'Shipping'
        ];
    }
}

?>