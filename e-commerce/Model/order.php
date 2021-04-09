<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Order extends Core\Table{
    
    public function __construct(){
        $this->setTableName('order');
        $this->setPrimaryKey('orderId');
    }
}

?>