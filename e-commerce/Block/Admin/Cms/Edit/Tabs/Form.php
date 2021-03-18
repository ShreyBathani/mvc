<?php

namespace Block\Admin\Cms\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Cms\Edit');

Class Form extends \Block\Admin\Cms\Edit
{
    public function __construct() {
        $this->setTemplate('View/admin/cms/edit/tabs/form.php');
    }
}

?>