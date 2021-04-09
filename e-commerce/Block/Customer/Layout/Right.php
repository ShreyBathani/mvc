<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Right');

class Right extends \Block\Core\Layout\Right{
    public function __construct() {
        $this->setTemplate('View/customer/layout/right.php');   
    }
}

?>