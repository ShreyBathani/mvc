<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $categories = null;
    protected $categoryOptions = [];

    public function __construct()
    {
        $this->setTemplate('View/admin/category/grid.php');
    }

    public function setCategories($categories = null){
        if (!$categories) {
            $category = \Mage::getModel('Model\Category');
            $categories = $category->fetchAll();
        }
        $this->categories = $categories;
        return $this;
    }

    public function getCategories(){
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
    }

    public function getName($category)
    {
        if (!$this->categoryOptions) {
            $categoryModel = \Mage::getModel('Model\Category');

            $query = "SELECT `categoryId`, `name` FROM `{$categoryModel->getTableName()}`;";
            $this->categoryOptions = $categoryModel->getadapter()->fetchPairs($query);
        }
        $pathIds = explode("=>", $category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id, $this->categoryOptions)) {
                $id = $this->categoryOptions[$id];
            }
        }
        $name = implode("=>", $pathIds);
        return $name;
    }
}

?>