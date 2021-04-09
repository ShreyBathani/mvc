<?php

namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Content');

class Content extends \Block\Core\Layout\Content{
    public function __construct() {
        $this->setTemplate('View/admin/layout/content.php');   
    }
}

?>