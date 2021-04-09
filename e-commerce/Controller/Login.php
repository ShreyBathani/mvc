<?php

namespace Controller;

class Login extends \Controller\Core\Customer
{
    public function indexAction()
    {
        $indexBlock = \Mage::getBlock('Block\Login\Index');
        $layout = $this->getLayout()->setTemplate('View/customer/loginLayout.php')->getContent()->addChild($indexBlock);
        
        $this->renderLayout();
    }

    public function loginAction()
    {
        try {
            $loginData = $this->getRequest()->getPost('login');
            $query = "SELECT * FROM `admin` WHERE `userName` = '{$loginData['email']}' AND `password` = '{$loginData['password']}';";
            $admin = \Mage::getModel('Model\Admin')->fetchRow($query);
            if ($admin) {
                if ($admin->status) {
                    $adminSession = \Mage::getModel('Model\Admin\Session');
                    $adminSession->adminId = $admin->adminId;
                    $this->redirect('index', 'Admin\Index');
                }
                throw new \Exception("Your Account is Disabled !");
            }
            
            $query = "SELECT * FROM `customer` WHERE `email` = '{$loginData['email']}' AND `password` = '{$loginData['password']}';";
            $customer = \Mage::getModel('Model\Customer')->fetchRow($query);
            if ($customer) {
                if ($customer->status) {
                    $customerSession = \Mage::getModel('Model\Customer\Session');
                    $customerSession->customerId = $customer->customerId;
                    $this->redirect('index', 'Home');
                }
                throw new \Exception("Your Account is Disabled !");
            }
            throw new \Exception("Invalid EmailId or Password !");
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }        
        $this->goback();
    }

    public function logoutAction()
    {
        $adminSession = \Mage::getModel('Model\Admin\Session');
        unset($adminSession->adminId);
        $customerSession = \Mage::getModel('Model\Customer\Session');
        unset($customerSession->customerId);
        $this->redirect('index', 'Home');
    }
}

?>