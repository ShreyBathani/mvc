<?php
namespace Controller\Core;

\Mage::loadFileByClassName('Block\Admin\Layout');

Class Abstracts {
    protected $request = null;
    protected $layout = null;
    protected $message = null;

    public function __construct(){
        $this->setRequest();
        $this->setMessage();
    }

    public function setRequest(){
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this->request;
    }
    
    public function getRequest(){
        if(!$this->request){
            $this->setRequest();
        }
        return $this->request;
    }

    public function setLayout(\Block\Admin\Layout $layout = null)
    {
        if (!$layout) {
            $layout = new \Block\Admin\Layout();
        }
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        if (!$this->layout) {
            $this->setLayout();
        }
        return $this->layout;
    }

    public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
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

    public function redirect($actionName = null, $controllerName = null, $params = null, $resetParams = false){
        $url = $this->getUrl($actionName, $controllerName, $params, $resetParams);
        header("location: {$url}");
        exit(0);
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

    public function getMessage()
    {
        if(!$this->message){
            $this->setMessage();
        }
        return $this->message;
    }

    public function makeResponse($content = "", $left = "", $right = "")
    {
        $response = [
            'element' => [
                [
                    'selector' => '#content',
                    'html' => $content
                ],
                [
                    'selector' => '#message',
                    'html' => \Mage::getBlock('Block\Core\Layout\Message')->toHtml(),
                ],
                [
                    'selector' => '#left',
                    'html' => $left
                ],
                [
                    'selector' => '#right',
                    'html' => $right
                ]
            ]
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}


?>