<?php

namespace Controller;

class Register extends \Controller\Core\Customer
{
    public function indexAction()
    {
        $indexBlock = \Mage::getBlock('Block\Register\Index');
        $layout = $this->getLayout()->setTemplate('View/customer/loginLayout.php')->getContent()->addChild($indexBlock);
        
        $this->renderLayout();
    }

    public function registerAction()
    {
        try {
            $registerData = $this->getRequest()->getPost('register');
            date_default_timezone_set("Asia/Calcutta");
            
            $query = "SELECT * FROM `customer` WHERE `email` = '{$registerData['email']}';";
            $admin = \Mage::getModel('Model\Admin')->fetchRow($query);
            if ($admin) {
                throw new \Exception("Email Already Exists !");
            }

            $query = "SELECT * FROM `customer` WHERE `phone` = '{$registerData['phone']}';";
            $admin = \Mage::getModel('Model\Admin')->fetchRow($query);
            if ($admin) {
                throw new \Exception("Phone Number Already Exists !");
            }

            $customer = \Mage::getModel('Model\Customer');
            $customer->setData($registerData);
            $customer->updatedDate = $customer->createdDate = date("Y-m-d H:i:s");
            $customer->status = 1;
            if(!$customer->save()){
                throw new \Exception("Error Processing Data.");
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->goback();
        }
        $this->redirect('index', 'Login');
    }
}

?>