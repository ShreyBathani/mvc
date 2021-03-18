<?php
namespace Controller\Core;

\Mage::loadFileByClassName('Block\Admin\Layout');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Admin extends \Controller\Core\Abstracts{

    public function setLayout(\Block\Admin\Layout $layout = null)
    {
        if (!$layout) {
            $layout = new \Block\Admin\Layout();
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

}


?>