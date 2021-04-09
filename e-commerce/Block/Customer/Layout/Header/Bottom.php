<?php

namespace Block\Customer\Layout\Header;

\Mage::loadFileByClassName('Block\Core\Layout\Header');

class Bottom extends \Block\Core\Layout\Header{
    
    protected $categories = null; 
    
    public function __construct() {
        $this->setTemplate('View/customer/layout/header/bottom.php');   
    }

    public function setCategories()
    {
        $category = \Mage::getModel('Model\Category');
        $query = "SELECT `categoryId`, `name`, `parentId` FROM `{$category->getTableName()}`;";
        $this->categories = $category->fetchAll($query);
        return $this;
    }

    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }
}

?>