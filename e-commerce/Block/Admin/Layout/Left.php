<?php

namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Left');

class Left extends \Block\Core\Layout\Left{
    public function __construct() {
        $this->setTemplate('View/admin/layout/left.php');   
    }
}

?>