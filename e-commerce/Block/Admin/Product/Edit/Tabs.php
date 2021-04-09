<?php

namespace Block\Admin\Product\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs
{
    /* public function __construct()
    {   
        $this->setTemplate('View/admin/product/edit/tabs.php');
        $this->prepareTab();
    } */
    
    public function prepareTab()
    {
        $this->addTab('product', ['label' => 'Product Information', 'block' => 'Block\Admin\Product\Edit\Tabs\Form']);
        $this->addTab('media', ['label' => 'Media', 'block' => 'Block\Admin\Product\Edit\Tabs\Media']);
        $this->addTab('groupPrice', ['label' => 'Group Price', 'block' => 'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        $this->addTab('attribute', ['label' => 'Attributes', 'block' => 'Block\Admin\Product\Edit\Tabs\Attribute']);
        $this->setDefaultTab('product');
        return $this;
    }

    public function getTabs()
    {
        if (!$this->getTableRow()->productId) {
            $this->removeTab('media');
            $this->removeTab('groupPrice');
            $this->removeTab('attribute');
        };
        return $this->tabs;
    }
}

?>