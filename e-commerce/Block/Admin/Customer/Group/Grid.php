<?php

namespace Block\Admin\Customer\Group;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $customerGroups = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/customer/group/grid.php');
    }

    public function setCustomerGroups($customerGroups = null){
        if (!$customerGroups) {
            $customerGroup = \Mage::getModel('Model\Customer\Group');
            $customerGroups = $customerGroup->fetchAll();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }

    public function getCustomerGroups(){
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }
}

?>