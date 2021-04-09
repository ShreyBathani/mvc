<?php
namespace Block\Home\Index;
\Mage::loadFileByClassName('Block\Core\Template');

class Brands extends \Block\Core\Template
{
    function __construct()
    {
        $this->setTemplate('./View/home/index/brands.php');
    }
}