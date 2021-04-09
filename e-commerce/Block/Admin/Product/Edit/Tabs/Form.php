<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Product\Edit');

Class Form extends \Block\Admin\Product\Edit
{   
    protected $categoryOptions = [];
    protected $selectedCategory = [];

    public function __construct() {
        $this->setTemplate('View/admin/product/edit/tabs/form.php');
    }

    public function getCategoryOptions()
    {
        if (!$this->categoryOptions) {
            $category = \Mage::getModel('Model\Category');
            $query = "SELECT `categoryId`, `name` FROM `{$category->getTableName()}`;";
            $options = $category->getAdapter()->fetchPairs($query);

            $query = "SELECT `categoryId`, `pathId` FROM `{$category->getTableName()}`;";
            $this->categoryOptions = $category->getAdapter()->fetchPairs($query);
            if (!$this->categoryOptions) {
                $this->categoryOptions = [];
            }
            if ($this->categoryOptions) {
                foreach ($this->categoryOptions as $categoryId => &$pathId) {
                    $pathIds = explode("=>", $pathId);
                    foreach ($pathIds as $key => &$id) {
                        if (array_key_exists($id, $options)) {
                            $id = $options[$id];
                        }
                    }
                    $pathId = implode("=>", $pathIds);
                }
            }
        }
        return $this->categoryOptions;
    }

    public function getSelectedCategory()
    {
        if ($this->selectedCategory) {
            return $this->selectedCategory;
        }
        $productCategory = \Mage::getModel('Model\Product\Category');
        $query = "SELECT `{$productCategory->getPrimaryKey()}`, `categoryId` FROM `{$productCategory->getTableName()}` WHERE `productId` = '{$this->getTableRow()->productId}';";
        $this->selectedCategory = $productCategory->getAdapter()->fetchPairs($query);
        
        if(!$this->selectedCategory) {
           $this->selectedCategory = []; 
        }
        return $this->selectedCategory;
    }
}



?>