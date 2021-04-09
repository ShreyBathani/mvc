<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Head');

class Head extends \Block\Core\Layout\Head{
    public function __construct() {
        $this->setTemplate('View/customer/layout/head.php');   
    }
}

?>