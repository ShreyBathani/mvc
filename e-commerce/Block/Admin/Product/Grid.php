<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    /* protected $products = null;

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
    } */

    public function setModel()
    {
        $this->model = \Mage::getModel('Model\Product');
    }

    public function prepareColumns()
    {
        $this->addColumn('productId',[
			'field' => 'productId',
			'label' => 'Product Id',
			'type'	=> 'number',
		]);
		$this->addColumn('sku',[
			'field' => 'sku',
			'label' => 'Sku',
			'type'	=> 'text',
		]);
		$this->addColumn('name',[
			'field' => 'name',
			'label' => 'Name',
			'type'	=> 'text',
		]);
		$this->addColumn('price',[
			'field' => 'price',
			'label' => 'Price',
			'type'	=> 'number',
		]);
		$this->addColumn('discount',[
			'field' => 'discount',
			'label' => 'Discount',
			'type'	=> 'number',
		]);
		$this->addColumn('quantity',[
			'field' => 'quantity',
			'label' => 'Quantity',
			'type'	=> 'number',
		]);
		$this->addColumn('status',[
			'field' => 'status',
			'label' => 'Status',
			'type'	=> 'number',
		]);
        return $this;
    }

    public function prepareButtons()
    {
        $this->addButton('addNew',[
            'label' => 'Add New',
            'class' => 'btn btn-success',// float-right mb-3 ml-2
            'method' => 'getAddNewUrl',
            'ajax' => true,
        ]);
        /* $this->addButton('applyFilter',[
            'label' => 'Apply Filter',
            'class' => 'btn btn-success ml-2',
            'method' => 'getAddNewUrl',
            'ajax' => true,
        ]); */
        return $this;
    }

    public function getAddNewUrl()
    {
        return $this->geturl('form', null, null, true);
    }

    /* public function getFilterUrl()
    {
        return $this->geturl('filter', null, null, true);
    } */

    public function prepareActions()
    {
        $this->addAction('edit',[
            'label' => '<i class=\'far fa-edit\'></i>',
            'class' => 'btn btn-success',
            'method' => 'getEditUrl',
            'ajax' => true,
        ]);
        $this->addAction('delete',[
            'label' => '<i class=\'fas fa-trash-alt\'></i>',
            'class' => 'btn btn-danger',
            'method' => 'getDeleteUrl',
            'ajax' => true,
        ]);
        $this->addAction('addToCart',[
            'label' => '<i class=\'fa fa-shopping-cart\'></i>',
            'class' => 'btn btn-info',
            'method' => 'getAddToCartUrl',
            'ajax' => true,
        ]);
        return $this;
    }

    public function getEditUrl($row)
    {
        return $this->geturl('form', null, ['productId' => $row->productId], true);
    }
    
    public function getDeleteUrl($row)
    {
        return $this->geturl('delete', null, ['productId' => $row->productId], true);
    }

    public function getAddToCartUrl($row)
    {
        return $this->geturl('addToCart', 'Admin\Cart', ['productId' => $row->productId], true);
    }

    public function getTitle()
    {
        return 'Manage Product';
    }
}

?>