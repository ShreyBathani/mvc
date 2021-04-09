<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Test extends \Controller\Core\Admin{

    public function testAction(){
        $num = 456;
        $factor = 21;
        $lenOfFactor = strlen($factor);
        /* while ($factor <= $num) {
            $a = floor($num/((10)**($lenOfFactor-1)));
            if ($a < $factor) {
                $a = floor($num/((10)**($lenOfFactor-2)));
            }
            $x = $a/$factor;
        } */
    }
}