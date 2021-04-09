<?php

namespace Block\Admin\Order;

Class Index extends \Block\Core\Grid{
    
    public function __construct()
    {
        $this->setTemplate('View/admin/order/index.php');
    }
}