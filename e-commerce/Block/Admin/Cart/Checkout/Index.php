<?php
namespace Block\Admin\Cart\Checkout;

class Index extends \Block\Core\Template
{
    protected $cart = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $paymentMethods = null;
    protected $shippingMethods = null;

    function __construct()
    {
        $this->setTemplate('./View/admin/cart/checkout/index.php');
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            throw new \Exception("Cart is not set");
        }
        return $this->cart;
    }

    public function setBillingAddress($billingAddress = null)
    {
        $address = $this->getCart()->getBillingAddress();
        if ($address) {
            $this->billingAddress = $address;
            return $this;
        }
        
        $billingAddress = $this->getCart()->getCustomer()->getBillingAddress();
        if ($billingAddress) {
            $cartBillingAddress = \Mage::getModel('Model\Cart\Address');
            $cartBillingAddress->setData($billingAddress->getOriginalData());
            unset($cartBillingAddress->customerId);
            $cartBillingAddress->cartId = $this->getCart()->cartId;
            $cartBillingAddress->firstName = $this->getCart()->getCustomer()->firstName;
            $cartBillingAddress->lastName = $this->getCart()->getCustomer()->lastName;
            $cartBillingAddress->save();
            $this->billingAddress = $cartBillingAddress;
            return $this;
        }
        $this->billingAddress = \Mage::getModel('Model\Cart\Address');
        return $this;
    }

    public function getBillingAddress()
    {
        if (!$this->billingAddress) {
            $this->setBillingAddress();
        }
        return $this->billingAddress;
    }

    public function setShippingAddress()
    {
        $address = $this->getCart()->getShippingAddress();
        if ($address) {
            $this->shippingAddress = $address;
            return $this;
        }
        $shippingAddress = $this->getCart()->getCustomer()->getShippingAddress();
        if ($shippingAddress) {
            $cartShippingAddress = \Mage::getModel('Model\Cart\Address');
            $cartShippingAddress->setData($shippingAddress->getOriginalData());
            unset($cartShippingAddress->customerId);
            $cartShippingAddress->cartId = $this->getCart()->cartId;
            $cartShippingAddress->firstName = $this->getCart()->getCustomer()->firstName;
            $cartShippingAddress->lastName = $this->getCart()->getCustomer()->lastName;
            $cartShippingAddress->save();
            $this->shippingAddress = $cartShippingAddress;
            return $this;
        }
        $this->shippingAddress = \Mage::getModel('Model\Cart\Address');
        return $this;
    }

    public function getShippingAddress()
    {
        if (!$this->shippingAddress) {
            $this->setShippingAddress();
        }
        return $this->shippingAddress;
    }

    public function setPaymentMethods(\Model\PaymentMethod\Collection $paymentMethods)
	{
		$this->paymentMethods = $paymentMethods;
		return $this;
	}

	public function getPaymentMethods()
	{
		if($this->paymentMethods)
		{
			return $this->paymentMethods;
		}
		$paymentMethods = \Mage::getModel('Model\PaymentMethod')->fetchAll();
		if(!$paymentMethods){
            return false;
        }
        $this->setPaymentMethods($paymentMethods);
		return $this->paymentMethods;
	}

    public function setShippingMethods(\Model\ShippingMethod\Collection $shippingMethods)
	{
		$this->shippingMethods = $shippingMethods;
		return $this;
	}

	public function getShippingMethods()
	{
		if($this->shippingMethods)
		{
			return $this->shippingMethods;
		}
		$shippingMethods = \Mage::getModel('Model\ShippingMethod')->fetchAll();
		if(!$shippingMethods){
            return false;
        }
        $this->setShippingMethods($shippingMethods);
		return $this->shippingMethods;
	}
}