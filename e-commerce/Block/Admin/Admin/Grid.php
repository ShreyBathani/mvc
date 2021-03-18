<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $admins = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/admin/grid.php');
    }

    public function setAdmins($admins = null){
        if (!$admins) {
            $admin = \Mage::getModel('Model\Admin');
            $admins = $admin->fetchAll();
        }
        $this->admins = $admins;
        return $this;
    }

    public function getAdmins(){
        if (!$this->admins) {
            $this->setAdmins();
        }
        return $this->admins;
    }
}

?>