<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Header');

class Header extends \Block\Core\Layout\Header{
    public function __construct() {
        $this->setTemplate('View/customer/layout/header.php');   
    }
}

?>