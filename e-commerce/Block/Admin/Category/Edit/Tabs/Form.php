<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Category\Edit');

Class Form extends \Block\Admin\Category\Edit
{
    //protected $category = null;
    protected $categories = null;
    protected $categoryOptions = [];
    
    public function __construct() {
        $this->setTemplate('View/admin/category/edit/tabs/form.php');
    }

   /*  public function setCategory($category = null){
        if ($category) {
            $this->$category = $category;
            return $this;
        }
        $category = \Mage::getModel('Model\Category');
        if($id = $this->getRequest()->getGet('categoryId')){
            $category = $category->load($id);
        }
        $this->category = $category;
        return $this;
    }

    public function getCategory(){
        if (!$this->category) {
            $this->setCategory();
        }
        return $this->category;
    } */

    public function setParentOptions()
    {   
        if ($this->categories) {
            return $this;
        }
        $this->categories = \Mage::getModel('Block\Category\Grid')->getCategories();
        return $this;
    }

    public function getParentOptions()
    {
        if (!$this->categories) {
            $this->setParentOptions();
        }
        return $this->categories;
    }

    public function getCategoryOptions()
    {
        if (!$this->categoryOptions) {
            $query = "SELECT `categoryId`, `name` FROM `{$this->getTableRow()->getTableName()}`;";
            $options = $this->getTableRow()->getAdapter()->fetchPairs($query);

            $pathId = '';
            if ($this->getTableRow()->pathId) {
                $pathId = $this->getTableRow()->pathId.'=>%';
            }
            $query = "SELECT `categoryId`, `pathId` FROM `{$this->getTableRow()->getTableName()}` WHERE NOT `pathId` = '{$this->getTableRow()->pathId}' AND `pathId` NOT LIKE '{$pathId}' ORDER BY `pathId` ASC;";
            $this->categoryOptions = $this->getTableRow()->getAdapter()->fetchPairs($query);
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
            $this->categoryOptions = ["0" => "Root"] + $this->categoryOptions;
        }
        return $this->categoryOptions;
    }
}

?>