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
}

?>