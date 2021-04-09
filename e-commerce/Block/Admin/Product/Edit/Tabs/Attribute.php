<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Product\Edit');

Class Attribute extends \Block\Admin\Product\Edit
{   
    protected $attributes = null;
    protected $product = null;

    public function __construct() {
        $this->setTemplate('View/admin/product/edit/tabs/attribute.php');
    }

    public function setAttributes($attributes = null){
        if ($attributes) {
            $this->$attributes = $attributes;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        $query = "SELECT * FROM `{$attribute->getTableName()}` WHERE `entityTypeId` = 'product' ORDER BY `sortOrder`;";
        $this->attributes = $attribute->fetchAll($query);
        return $this;
    }

    public function getAttributes(){
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
}

?>