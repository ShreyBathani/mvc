<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Cart extends Core\Table{

    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $paymentMethod = null;
    protected $shippingMethod = null;

    public function __construct()
    {
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }
        if (!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function setItems(\Model\Cart\Item\Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    public function getItems()
    {
        if ($this->items) {
            return $this->items;
        }
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM cart_item WHERE `cartId` = '{$this->cartId}';";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if ($items) {
            $this->setItems($items);
        }    
        return $this->items;
    }

    public function setBillingAddress(\Model\Cart\Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getBillingAddress()
    {
        if ($this->billingAddress) {
            return $this->billingAddress;
        }
        if (!$this->cartId) {
            return false;
        }
        $billingAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM {$billingAddress->getTableName()} WHERE `cartId` = '{$this->cartId}' AND `addressType` = '".\Model\Cart\Address::ADDRESS_TYPE_BILLING."';";
        if(!$billingAddress->fetchRow($query)){
            return false;
        }
        $this->setBillingAddress($billingAddress);
        return $this->billingAddress;
    }

    public function setShippingAddress(\Model\Cart\Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getShippingAddress()
    {
        if ($this->shippingAddress) {
            return $this->shippingAddress;
        }
        if (!$this->cartId) {
            return false;
        }
        $shippingAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM {$shippingAddress->getTableName()} WHERE `cartId` = '{$this->cartId}' AND `addressType` = '".\Model\Cart\Address::ADDRESS_TYPE_SHIPPING."';";
        if (!$shippingAddress->fetchRow($query)) {
           return false ;
        }
        $this->setShippingAddress($shippingAddress);
        return $this->shippingAddress;
    }

    public function setPaymentMethod(\Model\PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getpaymentMethod()
    {
        if ($this->paymentMethod) {
            return $this->paymentMethod;
        }
        if (!$this->cartId) {
            return false;
        }
        $paymentMethod = \Mage::getModel('Model\PaymentMethod');
        $query = "SELECT * FROM {$paymentMethod->getTableName()} WHERE `methodId` = '{$this->paymentMethodId}';";
        if(!$paymentMethod->fetchRow($query)){
            return false;
        }
        $this->setPaymentMethod($paymentMethod);
        return $this->paymentMethod;
    }

    public function setShippingMethod(\Model\ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    public function getShippingMethod()
    {
        if ($this->shippingMethod) {
            return $this->shippingMethod;
        }
        if (!$this->cartId) {
            return false;
        }
        $shippingMethod = \Mage::getModel('Model\ShippingMethod');
        $query = "SELECT * FROM {$shippingMethod->getTableName()} WHERE `methodId` = '{$this->shippingMethodId}';";
        if(!$shippingMethod->fetchRow($query)){
            return false;
        }
        $this->setShippingMethod($shippingMethod);
        return $this->shippingMethod;
    }

    public function getTotal()
    {
        $items = $this->getItems();
        $total = 0;
        if($items){
            foreach ($items->getData() as $item) {
                $total += ($item->quantity * $item->price) - ($item->quantity * $item->discount);
            }
        }
        return $total;
    }

    public function addItemToCart(\Model\Product $product, $quantity = 1, $addModel = false)
    {
        $item = \Mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `{$item->getTableName()}` WHERE `cartId` = {$this->cartId} AND `productId` = '{$product->productId}'";
        $item = $item->fetchRow($query);
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
            return true;
        }
        $item = \Mage::getModel('Model\Cart\Item');
        $item->cartId = $this->cartId;
        $item->productId = $product->productId;
        $item->basePrice = $product->price;
        $item->price = $product->price;
        $item->quantity = $quantity;
        $item->discount = $product->discount;
        $item->createdDate = date("Y-m-d H:i:s");
        $item->save();
        return true;
    }
}

?>