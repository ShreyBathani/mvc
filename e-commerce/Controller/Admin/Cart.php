<?php 

namespace Controller\Admin;

class Cart extends \Controller\Core\Admin
{
	public function gridAction()
	{
		try {
			$cart = $this->getCart();
			$grid = \Mage::getBlock('Block\Admin\Cart\Grid')->setCart($cart);
			//$layout = $this->getLayout();
			//$content = $layout->getContent()->addChild($grid);
			//$this->renderLayout();
            $this->makeResponse($grid->toHtml());
		} 
        catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
	}
		
	public function getCart($customerId = null)
	{
		$session = \Mage::getModel('Model\Admin\Session');
		if($customerId)
		{
			$session->customerId = $customerId;		
		}

		$cart = \Mage::getModel('Model\Cart');
		$query = "SELECT * FROM `{$cart->getTableName()}` WHERE `customerId` = '{$session->customerId}'";
		$cart = $cart->fetchRow($query);

		if($cart)
		{
			return $cart;
		}

		$cart = \Mage::getModel('Model\Cart');
		$cart->customerId = $session->customerId;
		date_default_timezone_set("Asia/Calcutta");
		$cart->createdDate = date('Y-m-d H:i:s');
		$cart->save();
		return $cart;
	}

	public function addToCartAction()
	{
		try {
			$productId = (int)$this->getRequest()->getGet('productId');
			$product = \Mage::getModel('Model\Product')->load($productId);
			if(!$product)
			{
				throw new \Exception("Product is not valid.");
			}
			$cart = $this->getCart();
			$cart->addItemToCart($product, 1, true);
			
			$cart->total = $cart->getTotal();
			$cart->save();

			$this->getMessage()->setSuccess("Item added to cart.");
			
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$this->gridAction();
	}

	public function updateAction()
	{
		try{
			$quantities = $this->getRequest()->getPost('quantity');
			$priceses = $this->getRequest()->getPost('price');
			foreach ($quantities as $cartItemId => $quantity) {
				$cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
				if(!$cartItem)
				{
					throw new \Exception("Product Not Available");
				}
				if($quantity == 0){
					$cartItem->delete();
					continue;
				}
				$cartItem->price = $priceses[$cartItemId];
				$cartItem->quantity = $quantity;
				$cartItem->save();
			}

			$cart = $this->getCart();
			$cart->total = $cart->getTotal();
			$cart->save();

			$this->getMessage()->setSuccess("Cart updated successfully.");
		}
		catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$this->gridAction();
	}

	public function deleteAction()
	{
		try{
			$cartItemId = $this->getRequest()->getGet('cartItemId');
			$cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
			if(!$cartItem)
			{
				throw new \Exception("Requested Item is not Available");
			}
			if(!$cartItem->delete())
			{
				throw new \Exception("Error Processing Request");
			}

			$cart = $this->getCart();
			$cart->total = $cart->getTotal();
			$cart->save();

			$this->getMessage()->setSuccess('Item deleted successfully');
		}
		catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
		$this->gridAction();

	}
	public function selectCustomerAction()
	{
		$customerId = $this->getRequest()->getPost('customer');
		$cart = $this->getCart($customerId);

		$this->gridAction();
	}
}

?>