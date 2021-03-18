<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class PayMentMethod extends Core\Table{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    
    public function __construct(){
        $this->setTableName('payment_method');
        $this->setPrimaryKey('methodId');
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED => 'Enabled'
        ];
    }
}

?>