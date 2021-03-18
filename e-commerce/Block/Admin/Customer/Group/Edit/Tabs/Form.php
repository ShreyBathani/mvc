<?php

namespace Block\Admin\Customer\Group\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Customer\Group\Edit');

Class Form extends \Block\Admin\Customer\Group\Edit
{
    
    public function __construct() {
        $this->setTemplate('View/admin/customer/group/edit/tabs/form.php');
    }
}

?>