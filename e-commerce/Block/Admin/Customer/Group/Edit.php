<?php

namespace Block\Admin\Customer\Group;

\Mage::loadFileByClassName('Block\Core\Edit');

Class Edit extends \Block\Core\Edit{

    public function __construct(){
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Customer\Group\Edit\Tabs'));
    }
}

?>