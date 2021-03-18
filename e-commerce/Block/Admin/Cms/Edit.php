<?php

namespace Block\Admin\Cms;

\Mage::loadFileByClassName('Block\Core\Edit');

Class Edit extends \Block\Core\Edit{

    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Cms\Edit\Tabs'));
    }
}

?>