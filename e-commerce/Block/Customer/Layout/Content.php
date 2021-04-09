<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Content');

class Content extends \Block\Core\Layout\Content{
    public function __construct() {
        $this->setTemplate('View/customer/layout/content.php');   
    }
}

?>