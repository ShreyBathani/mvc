<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Customer\Edit');

Class Form extends \Block\Admin\Customer\Edit
{
    protected $customerGroup = null;

    public function __construct() {
        $this->setTemplate('View/admin/customer/edit/tabs/form.php');
    }

    public function getCustomerGroups()
    {
        $this->customerGroup = \Mage::getBlock('Block\Admin\Customer\Group\Grid');
        return $this->customerGroup->getCustomerGroups();
    }
}

?>