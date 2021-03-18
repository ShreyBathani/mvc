<?php

namespace Model\Core;

class Url
{
    protected $request = null;

    public function __construct() {
        $this->setRequest();
    }

    public function setRequest()
    {
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getUrl($actionName = null, $controllerName = null, $params = null, $resetParams = false){
        $final = $_GET;
        if($resetParams){
            $final = [];
        }
        if($actionName == null){
            $actionName = $this->getRequest()->getActionName();
        }
        if($controllerName == null){
            $controllerName = $this->getRequest()->getControllerName();
        }

        $final['c'] = $controllerName;
        $final['a'] = $actionName;

        if(is_array($params)){
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        unset($final);
        return "http://localhost/e-commerce/index.php?{$queryString}";
    }

    public function baseUrl($subUrl = null)
    {
        $url = "http://localhost/e-commerce/";
        if ($subUrl) {
            $url = $url.$subUrl;
        }
        return $url;
    }
}


?>