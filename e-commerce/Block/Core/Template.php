<?php
namespace Block\Core;

class Template
{
    protected $template = null;
    protected $controller = null;
    protected $children = [];
    protected $message = null;
    protected $request = null;
    protected $url = null;
    
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function toHtml(){
        ob_start();
		require $this->getTemplate();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
    }

    public function setUrlObject()
    {
        if (!$this->url) {
            $this->url = \Mage::getModel('Model\Core\Url');
        }
        return $this;
    }

    public function getUrlObject()
    {
        if (!$this->url) {
            $this->setUrlObject();
        }
        return $this->url;
    }

    public function setRequest()
    {
        if (!$this->request) {
            $this->request = \Mage::getModel('Model\Core\Request');
        }
        return $this;
    }

    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest();
        }
        return $this->request;
    }

    public function setController(\Controller\Core\Admin $controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getUrl($actionName = null, $controllerName = null, $params = null, $resetParams = false)
    {
        return $this->getUrlObject()->getUrl($actionName, $controllerName, $params, $resetParams);
    }

    public function setChildren(array $children = [])
    {
        $this->children = $children;
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addChild(Template $child, $key = null)
    {
        if (!$key) {
            $key = get_class($child);
        }
        $this->children[$key] = $child;
        return $this;
    }

    public function getChild($key)
    {
        if (!array_key_exists($key, $this->children)) {
            return null;
        }
        return $this->children[$key];
    }

    public function removeChild($key)
    {   
        if (array_key_exists($key, $this->children)) {
            unset($this->children[$key]);
        }
        return $this;
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

    public function getMessage()
    {
        if(!$this->message) {
            $this->setMessage();
        }
        return $this->message;
    }

    public function baseUrl($subUrl = null)
    {
        return $this->getUrlObject()->baseUrl($subUrl);
    }

    protected $tabs = [];
    protected $defaultTab = null;

    public function setDefaultTab($defaultTab)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }
    
    public function getDefaultTab()
    {
        return $this->defaultTab;
    }

    public function setTabs(array $tabs = [])
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, $tab = [])
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    /* public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;            
        }
        return $this->tabs[$key];
    } */

    public function removeTab($key)
    {
        if (array_key_exists($key, $this->tabs)){
            unset($this->tabs[$key]);
        }
        return $this;
    }

    public function getBlock($className)
    {
        return \Mage::getBlock($className);
    }

    public function isLoggedIn()
    {
        $customerId = \Mage::getModel('Model\Customer\Session')->customerId;
        if (!$customerId) {
            return false;
        }
        return $customerId;
    }
}


?>