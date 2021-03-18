<?php

namespace Block\Admin\Admin\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Admin\Edit');

Class Form extends \Block\Admin\Admin\Edit
{
    public function __construct() {
        $this->setTemplate('View/admin/admin/edit/tabs/form.php');
    }
}

?>