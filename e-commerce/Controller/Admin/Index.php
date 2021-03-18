<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Index extends \Controller\Core\Admin 
{
    public function indexAction()
    {   
        $gridBlock = \Mage::getBlock('Block\Admin\Index\Grid');
        $layout = $this->getLayout()->getContent()->addChild($gridBlock);
        
        $this->renderLayout();
    }
}

?>