<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Left');

class Left extends \Block\Core\Layout\Left{
    public function __construct() {
        $this->setTemplate('View/customer/layout/left.php');   
    }
}

?>