<?php

namespace Block\Admin\Cms;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid{
    
    protected $cms = null;

    public function __construct()
    {
        $this->setTemplate('View/admin/cms/grid.php');
    }

    public function setCms($cms = null){
        if (!$cms) {
            $admin = \Mage::getModel('Model\Cms');
            $cms = $admin->fetchAll();
        }
        $this->cms = $cms;
        return $this;
    }

    public function getCms(){
        if (!$this->cms) {
            $this->setCms();
        }
        return $this->cms;
    }
}

?>