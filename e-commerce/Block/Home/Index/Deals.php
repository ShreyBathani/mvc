<?php
namespace Block\Home\Index;
\Mage::loadFileByClassName('Block\Core\Template');

class Deals extends \Block\Core\Template
{
    function __construct()
    {
        $this->setTemplate('./View/home/index/deals.php');
    }
}