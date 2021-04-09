<?php

namespace Block\Home\Index;

\Mage::loadFileByClassName('Block\Core\Layout\Content');

class Banner extends \Block\Core\Layout\Content{
    public function __construct() {
        $this->setTemplate('View/home/index/banner.php');   
    }
}

?>