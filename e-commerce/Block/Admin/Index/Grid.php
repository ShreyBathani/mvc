<?php

namespace Block\Admin\Index;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid
{
    public function __construct() {
        $this->setTemplate('View/admin/index/grid.php');
    }
}


?>