<?php
namespace Controller\Core;

\Mage::loadFileByClassName('Block\Customer\Layout');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Customer extends \Controller\Core\Abstracts{

    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout = new \Block\Customer\Layout();
        }
        if (!$layout instanceof \Block\Customer\Layout) {
            throw new \Exception("Must be instance of \Block\Customer\Layout");
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Customer\Message');
        return $this;
    }

}


?>
