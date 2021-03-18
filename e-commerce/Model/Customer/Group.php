<?php

namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Table');

class Group extends \Model\Core\Table{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    
    public function __construct(){
        $this->setTableName('customer_group');
        $this->setPrimaryKey('groupId');
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED => 'Enabled'
        ];
    }
}

?>