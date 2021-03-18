<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $customers = null;
    protected $customerGroup = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/customer/grid.php');
    }

    public function setCustomers($customers = null){
        if (!$customers) {
            $customer = \Mage::getModel('Model\Customer');
            $query = "SELECT c.`customerId`, c.`firstName`, c.`lastName`, c.`email`, c.`password`, c.`phone`, c.`status`, cg.`name`, ca.`zipcode` 
            FROM customer c 
            LEFT JOIN customer_group cg 
                ON c.`groupId` = cg.`groupId`
            LEFT JOIN customer_address ca 
                ON c.`customerId` = ca.`customerId` 
                AND ca.addressType = 'billing'
            ORDER BY `{$customer->getPrimaryKey()}` ASC;";
            $customers = $customer->fetchAll($query);
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers(){
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }
}

?>