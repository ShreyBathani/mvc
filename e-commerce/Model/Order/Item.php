<?php

namespace Model\Order;

\Mage::loadFileByClassName('Model\Core\Table');

class Item extends \Model\Core\Table{
    
    public function __construct(){
        $this->setTableName('order_item');
        $this->setPrimaryKey('orderItemId');
    }
}

?>