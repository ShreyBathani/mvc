<?php
namespace Block\Home\Index;
\Mage::loadFileByClassName('Block\Core\Template');

class Category extends \Block\Core\Template
{
    function __construct()
    {
        $this->setTemplate('./View/home/index/category.php');
    }
}