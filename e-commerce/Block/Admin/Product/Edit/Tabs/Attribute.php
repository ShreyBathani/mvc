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

    /* public function setProduct($product = null)
    {
        if ($product) {
            $this->$product = $product;
            return $this;
        }
        $product = \Mage::getModel('Model\Product');
        if($id = $this->getRequest()->getGet('productId')){
            $product = $product->load($id);
        }
        $this->product = $product;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }
        return $this->product;
    } */
}

?>