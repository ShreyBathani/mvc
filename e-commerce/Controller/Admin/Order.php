<?php

namespace Controller\Admin;

class Order extends \Controller\Core\Admin{
    
    public function indexAction()
    {
        $indexBlock = \Mage::getBlock('Block\Admin\Order\Index')->toHtml();
        $this->makeResponse($indexBlock);
    }

    public function placeOrderAction()
    {
        date_default_timezone_set("Asia/Calcutta");
        
        $cartId = (int) $this->getRequest()->getGet('cartId');
        $cart = \Mage::getModel('Model\Cart')->load($cartId);

        $customer = $cart->getCustomer();
        $paymentMethod = $cart->getPaymentMethod();
        $shippingMethod = $cart->getShippingMethod();
        
        $order = \Mage::getModel('Model\Order');
        $order->setData($cart->getOriginalData());

        
        unset($order->sessionId);
        unset($order->createdDate);
        $order->customerFirstName = $customer->firstName;
        $order->customerLastName = $customer->lastName;
        $order->email = $customer->email;
        $order->phone = $customer->phone;
        $order->paymentMethodId = $cart->paymentMethodId;
        $order->paymentMethodName = $paymentMethod->name;
        $order->paymentMethodCode = $paymentMethod->code;
        $order->shippingMethodId = $cart->shippingMethodId;
        $order->shippingMethodName = $shippingMethod->name;
        $order->shippingMethodCode = $shippingMethod->code;
        //$order->status = 1;
        $order->createdDate = date('Y-m-d H:i:s');


        if ($order->save()) {
            $orderId = $order->orderId;
            $this->saveOrderItemsAction($cart, $orderId);
            $this->saveOrderAddressAction($cart, $orderId);
            $this->deleteCartAction($cart);

            $this->getMessage()->setSuccess('Order Successfully Placed');
        }
    }

    public function saveOrderItemsAction(\Model\Cart $cart, $orderId)
    {
        $cartItems = $cart->getItems();
        
        foreach ($cartItems->getData() as $cartItem) {
            $orderItem = \Mage::getModel('Model\Order\Item');
            $orderItem->setData($cartItem->getOriginalData());
            $orderItem->orderId = $orderId;
            unset($orderItem->cartId);
            unset($orderItem->cartItemId);
            unset($orderItem->createdDate);

            $product = $cartItem->getProduct();
            $orderItem->sku = $product->sku;
            $orderItem->name = $product->name;
            $orderItem->total = ($orderItem->price -$orderItem->discount) * $orderItem->quantity;

            $orderItem->save();
        }

    }

    public function saveOrderAddressAction(\Model\Cart $cart, $orderId)
    {
        $cartBillingAddress = $cart->getBillingAddress();
        
        $orderBillingAddress = \Mage::getModel('Model\Order\Address');
        $orderBillingAddress->setData($cartBillingAddress->getOriginalData());
        $orderBillingAddress->orderId = $orderId;
        unset($orderBillingAddress->cartId);
        unset($orderBillingAddress->cartAddressId);
        $orderBillingAddress->save();
        
        
        $cartShippingAddress = $cart->getShippingAddress();
        
        $orderShippingAddress = \Mage::getModel('Model\Order\Address');
        $orderShippingAddress->setData($cartShippingAddress->getOriginalData());
        $orderShippingAddress->orderId = $orderId;
        unset($orderShippingAddress->cartId);
        unset($orderShippingAddress->cartAddressId);
        $orderShippingAddress->save();
    }

    public function deleteCartAction(\Model\Cart $cart)
    {
        $cart->delete();
        $this->indexAction();
    }

}

?>