<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Category\Edit');

Class Media extends \Block\Admin\Category\Edit
{
    public function __construct() {
        $this->setTemplate('View/admin/category/edit/tabs/media.php');
    }
}

?>