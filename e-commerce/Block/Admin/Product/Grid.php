<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $products = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/product/grid.php');
    }

    public function setProducts($products = null){
        if (!$products) {
            $product = \Mage::getModel('Model\Product');
            $products = $product->fetchAll();
        }
        $this->products = $products;
        return $this;
    }

    public function getProducts(){
        if (!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }
}

?>