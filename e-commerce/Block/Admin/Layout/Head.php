<?php

namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Head');

class Head extends \Block\Core\Layout\Head{
    public function __construct() {
        $this->setTemplate('View/admin/layout/head.php');   
    }
}

?>