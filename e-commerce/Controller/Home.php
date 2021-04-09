<?php

namespace Controller;

\Mage::loadFileByClassName('Controller\Core\Customer');

class Home extends Core\Customer
{
    public function indexAction()
    {
        $indexBlock = \Mage::getBlock('Block\Home\Index');
        $layout = $this->getLayout()->getContent()->addChild($indexBlock);
        $this->renderLayout();
    }
}

?>