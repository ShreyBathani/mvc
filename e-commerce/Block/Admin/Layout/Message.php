<?php

namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Message');

class Message extends \Block\Core\Layout\Message{
    public function __construct() {
        $this->setTemplate('View/admin/layout/message.php');   
    }
}

?>