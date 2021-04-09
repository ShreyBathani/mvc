<?php

namespace Block\Admin\ConfigGroup\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\ConfigGroup\Edit');

Class Information extends \Block\Admin\ConfigGroup\Edit
{
    public function __construct() {
        $this->setTemplate('View/admin/configGroup/edit/tabs/information.php');
    }
}

?>