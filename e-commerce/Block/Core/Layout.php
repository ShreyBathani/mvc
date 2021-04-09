<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Block\Core\Layout\Content');
\Mage::loadFileByClassName('Block\Core\Layout\Message');
\Mage::loadFileByClassName('Block\Core\Layout\Header');
\Mage::loadFileByClassName('Block\Core\Layout\Left');
\Mage::loadFileByClassName('Block\Core\Layout\Right');
\Mage::loadFileByClassName('Block\Core\Layout\Footer');

class Layout extends Template{
    
    public function __construct() {
        $this->setTemplate('View/core/oneColumn.php');
        $this->prepareChildren();
    }

    public function prepareChildren()
    {
        $this->addChild(new Layout\Header(), 'header');
        $this->addChild(new Layout\Message(), 'message');
        $this->addChild(new Layout\Content(), 'content');
        $this->addChild(new Layout\Left(), 'left');
        $this->addChild(new Layout\Right(), 'right');
        $this->addChild(new Layout\Footer(), 'footer');
    }

    public function getContent()
    {
        return $this->getChild('content');
    }

    public function getLeft()
    {
        return $this->getChild('left');
    }

    public function getRight()
    {
        return $this->getChild('right');
    }

    public function getMessage()
    {
        return $this->getChild('message');
    }
}

?>