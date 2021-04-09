<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Footer');

class Footer extends \Block\Core\Layout\Footer{
    public function __construct() {
        $this->setTemplate('View/customer/layout/footer.php');   
    }
}

?>