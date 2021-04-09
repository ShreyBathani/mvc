<?php
namespace Block\Home\Index;
\Mage::loadFileByClassName('Block\Core\Template');

class Support extends \Block\Core\Template
{
    function __construct()
    {
        $this->setTemplate('./View/home/index/support.php');
    }
}