<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName('Block\Core\Layout\Message');

class Message extends \Block\Core\Layout\Message{
    public function __construct() {
        $this->setTemplate('View/customer/layout/message.php');   
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Customer\Message');
        return $this;
    }
}

?>