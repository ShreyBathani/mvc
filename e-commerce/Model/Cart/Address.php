<?php

namespace Model\Cart;

\Mage::loadFileByClassName('Model\Core\Table');

class Address extends \Model\Core\Table{

    protected $cart = null;
    protected $customer = null;
    protected $customerBillingAddress = null;
    protected $customerShippingAddress = null;

    const ADDRESS_TYPE_BILLING = 'Billing';
    const ADDRESS_TYPE_SHIPPING = 'Shipping';

    public function __construct(){
        $this->setTableName('cart_Address');
        $this->setPrimaryKey('cartAddressId');
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }   

    public function getCart()
    {
        if ($this->cart) {
            return $this->cart;
        }
        if (!$this->cartId) {
            return false;
        }
        $cart = \Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

    public function setCustomerBillingAddress(\Model\Customer\Address $address)
    {
        $this->customerBillingAddress = $address;
        return $this;
    }

    public function getCustomerBillingAddress()
    {
        if ($this->customerBillingAddress) {
            return $this->customerBillingAddress;
        }
        if (!$this->addressId) {
            return false;
        }
        $address = \Mage::getModel('Model\Customer\Addreess')->load($this->addressId);
        $this->setCustomerBillingAddress($address);
        return $this->customerBillingAddress;
    }

    public function setCustomerShippingAddress(\Model\Customer\Address $address)
    {
        $this->customerShippingAddress = $address;
        return $this;
    }

    public function getCustomerShippingAddress()
    {
        if ($this->customerShippingAddress) {
            return $this->customerShippingAddress;
        }
        if (!$this->addressId) {
            return false;
        }
        $address = \Mage::getModel('Model\Customer\Addreess')->load($this->addressId);
        $this->setCustomerShippingAddress($address);
        return $this->customerShippingAddress;
    }

}

?>