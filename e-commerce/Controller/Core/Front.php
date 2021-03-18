<?php

namespace Controller\Core;

\Mage::loadFileByClassName('Model\Core\Request');

class Front {
    public static function init(){
        
        $request = \Mage::getModel('Model\Core\Request');
        $controllerName = ucfirst($request->getControllerName());
        $actionName = $request->getActionName()."Action";
        $controllerClassName = \Mage::prepareClassName('Controller', $controllerName);
        $controller = \Mage::getController($controllerClassName);
        $controller->$actionName();

    }
}

?>
