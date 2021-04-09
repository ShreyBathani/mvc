<?php
namespace Controller\Core;

\Mage::loadFileByClassName('Block\Admin\Layout');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Admin extends \Controller\Core\Abstracts{

    public function __construct() {
        $this->loginCheck();
    }

    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout = new \Block\Admin\Layout();
        }
        if (!$layout instanceof \Block\Admin\Layout) {
            throw new \Exception("Must be instance of \Block\Admin\Layout");
        }
        $this->layout = $layout;
        return $this;
    }

    public function setMessage()
    {
        $this->message = \Mage::getModel('Model\Admin\Message');
        return $this;
    }

    public function loginCheck()
    {
        try{
            $adminId = $this->isLoggedIn();
            if (!$adminId) {
                throw new \Exception("Invalid Id");
            }
            $admin = \Mage::getModel('Model\Admin')->load($adminId);
            if (!$admin) {
                throw new \Exception("Admin Not Found");
            }
        }
        catch(\Exception $e){
            $this->redirect('index', 'Login');
        }
    }

    public function isLoggedIn()
    {
        $adminId = \Mage::getModel('Model\Admin\Session')->adminId;
        if (!$adminId) {
            return false;
        }
        return $adminId;
    }

}


?>