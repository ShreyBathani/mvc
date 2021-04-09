<?php 

namespace Controller\Admin\Cart;

class Checkout extends \Controller\Core\Admin
{
    public function indexAction()
    {
        $indexBlock = \Mage::getBlock('Block\Admin\Cart\Checkout\Index')->setCart($this->getCart());
        /* $layout = $this->getLayout();
        $content = $layout->getContent()->addChild($indexBlock);
        $this->renderLayout(); */
        $this->makeResponse($indexBlock->toHtml());
    }

    public function getCart()
    {
		$session = \Mage::getModel('Model\Admin\Session');
        $customerId = $session->customerId;

        if(!$customerId) {
            return false;
        }

        $cart = \Mage::getModel('Model\Cart');
        $query = "SELECT * FROM {$cart->getTableName()} WHERE `customerId` = '{$customerId}'";

        if (!$cart->fetchRow($query)) {
            return false;
        }
        return $cart;
    }

    public function saveBillingAction()
    {
        try {
            $billingData = $this->getRequest()->getPost('billing');
            $saveBillnginFlag = $this->getRequest()->getPost('saveBillnginFlag');
            $cartBillingAddress = $this->getCart()->getBillingAddress();
            if (!$cartBillingAddress) {
                $cartBillingAddress = \Mage::getModel('Model\Cart\Address');
            }
            $cartBillingAddress->setData($billingData);
            $cartBillingAddress->sameAsBilling = 0;
            $cartBillingAddress->addressType = 'billing';
            $cartBillingAddress->cartId = $this->getCart()->cartId;
            if(!$cartBillingAddress->save()){
                throw new \Exception("Error in processing billing address");
            }
            if ($saveBillnginFlag) {
                $customer = $this->getCart()->getCustomer();
                $customerBillingAddress = $customer->getBillingAddress();
                if(!$customerBillingAddress) {
                    $customerBillingAddress = \Mage::getModel('Model\Customer\Address');
                }
                $customerBillingAddress->setData($billingData);
                $customerBillingAddress->customerId = $customer->customerId;
                $customerBillingAddress->addressType = 'billing';
                unset($customerBillingAddress->firstName);
                unset($customerBillingAddress->lastName);
                if(!$customerBillingAddress->save()) {
                    throw new \Exception("Error in storing Addressbook.");
                }
            }
            $this->getMessage()->setSuccess('Billing Address Successfully stored.');
        }
        catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
        $this->indexAction();
    }

    public function saveShippingAction()
    {
        try {
            $shippingData = $this->getRequest()->getPost('shipping');
            $saveShippingFlag = $this->getRequest()->getPost('saveShippingFlag');
            $sameAsBilling = $this->getRequest()->getPost('sameAsBilling');
            if ($sameAsBilling) {
                $shippingData = $this->getRequest()->getPost('billing');
            }

            $cartShippingAddress = $this->getCart()->getShippingAddress();
            if (!$cartShippingAddress) {
                $cartShippingAddress = \Mage::getModel('Model\Cart\Address');
            }
            $cartShippingAddress->setData($shippingData);
            if ($sameAsBilling) {
                $cartShippingAddress->sameAsBilling = 1;
            }
            else{
                $cartShippingAddress->sameAsBilling = 0;

            }
            $cartShippingAddress->addressType = 'shipping';
            $cartShippingAddress->cartId = $this->getCart()->cartId;
            if(!$cartShippingAddress->save()){
                throw new \Exception("Error in processing shipping address");
            }
            if ($saveShippingFlag) {
                $customer = $this->getCart()->getCustomer();
                $customerShippingAddress = $customer->getShippingAddress();
                if(!$customerShippingAddress) {
                    $customerShippingAddress = \Mage::getModel('Model\Customer\Address');
                }
                $customerShippingAddress->setData($shippingData);
                $customerShippingAddress->customerId = $customer->customerId;
                $customerShippingAddress->addressType = 'shipping';
                unset($customerShippingAddress->firstName);
                unset($customerShippingAddress->lastName);
                if(!$customerShippingAddress->save()) {
                    throw new \Exception("Error in storing addressbook.");
                }
            }
            $this->getMessage()->setSuccess('Shipping address successfully stored.');
        }
        catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
        $this->indexAction();
    }

    public function savePaymentMethodAction()
    {
        try{
            $paymentMethodId = (int) $this->getRequest()->getPost('paymentMethod');
            if(!$paymentMethodId){
                throw new \Exception("Please select shipping method.");
            }

            $paymentMethod = \Mage::getModel('Model\PaymentMethod')->load($paymentMethodId);
            if (!$paymentMethod) {
                throw new \Exception("Payment method not found.");
            }

            $cart = $this->getCart();
            if(!$cart){
                throw new \Exception("Cart not found.");
            }
            
            $cart->paymentMethodId = $paymentMethodId;
            if (!$cart->save()) {
                throw new \Exception("Error storing payment method.");
            }

            $this->getMessage()->setSuccess('Payment method successfully stored.');
        }
        catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
        $this->indexAction();
    }

    public function saveShippingMethodAction()
    {
        try{
            $shippingMethodId = (int) $this->getRequest()->getPost('shippingMethod');
            if(!$shippingMethodId){
                throw new \Exception("Please select shipping method.");
            }

            $shippingMethod = \Mage::getModel('Model\ShippingMethod')->load($shippingMethodId);
            if (!$shippingMethod) {
                throw new \Exception("Shipping method not found.");
            }

            $cart = $this->getCart();
            if(!$cart){
                throw new \Exception("Cart not found.");
            }
            
            $cart->shippingMethodId = $shippingMethodId;
            $cart->shippingAmount = $shippingMethod->amount;
            if (!$cart->save()) {
                throw new \Exception("Error storing shipping method.");
            }

            $this->getMessage()->setSuccess('Shipping method successfully stored.');
        }
        catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
        $this->indexAction();
    }
}