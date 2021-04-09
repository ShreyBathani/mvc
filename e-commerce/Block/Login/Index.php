<?php

namespace Block\Login;

Class Index extends \Block\Core\Grid
{
    public function __construct() {
        $this->setTemplate('View/login/index.php');
    }
}


?>