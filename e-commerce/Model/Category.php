<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Category extends Core\Table{
    
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    
    public function __construct(){
        $this->setTableName('category');
        $this->setPrimaryKey('categoryId');
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED => 'Enabled'
        ];
    }

    public function updatePathId()
    {   
        if (!$this->parentId) {
            $pathId = $this->categoryId;
        }
        else {
            $parent = \Mage::getModel('Model\Category')->load($this->parentId);
            if (!$parent) {
                throw new \Exception("Unable to load data");
            }
            $pathId = $parent->pathId.'=>'.$this->categoryId;
        }
        $this->pathId = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId, $categoryId = null, $parentId = null)
    {   
        $categoryPathId = $categoryPathId.'=>';
        $query = "SELECT * FROM {$this->getTableName()} WHERE `pathId` LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC;";
        $categories = $this->fetchAll($query);
        if ($categories) {
            foreach ($categories->getData() as $category) {
                if ($parentId != null) {
                    if ($category->parentId == $categoryId) {
                        $category->parentId = $parentId;
                    }
                }
                $category->updatePathId();
            }
        }
    }
}

?>