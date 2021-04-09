<?php

namespace Block\Admin\Brand;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid
{
    protected $brands = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/brand/grid.php');
    }

    public function setBrands($brands = null)
    {
        if (!$brands) {
            $brand = \Mage::getModel('Model\Brand');
            $brands = $brand->fetchAll();
        }
        $this->brands = $brands;
        return $this;
    }

    public function getBrands()
    {
        if (!$this->brands) {
            $this->setBrands();
        }
        return $this->brands;
    }

    public function getTitle()
    {
        return "Manage Brands";
    }
}

?>