<?php

namespace Block\Customer\Layout\Header;

\Mage::loadFileByClassName('Block\Core\Layout\Header');

class Top extends \Block\Core\Layout\Header{
    public function __construct() {
        $this->setTemplate('View/customer/layout/header/top.php');   
    }
}

?>