<?php $cart = $this->getCart(); ?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $paymentMethods = $this->getPaymentMethods(); ?>
<?php $shippingMethods = $this->getShippingMethods(); ?>

<div>
    <h2>Checkout</h2>
</div>
<hr>

<form action="<?php echo $this->getUrl('save'); ?>" method="POST" id="form" name="form">
    <div>
        <div class="w-50 pr-3 float-left">
            <div class="pt-3 pr-3 pl-3 border rounded">
                <h5>Billing Address</h5>
                <hr>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="firstName">First Name: </label>
                        <input type="text" name="billing[firstName]" id="firstName" class="form-control" value="<?php echo $billingAddress->firstName; ?>">
                    </div>
                    <div class="col-6">
                        <label for="lastName">Last Name: </label>
                        <input type="text" name="billing[lastName]" id="lastName" class="form-control" value="<?php echo $billingAddress->lastName; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="address">Customer Address: </label>
                        <input type="text" name="billing[address]" id="address" class="form-control" value="<?php echo $billingAddress->address; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="city">City: </label>
                        <input type="text" name="billing[city]" id="city" class="form-control" value="<?php echo $billingAddress->city; ?>">
                    </div>
                    <div class="col-6">
                        <label for="state">State: </label>
                        <input type="text" name="billing[state]" id="state" class="form-control" value="<?php echo $billingAddress->state; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="country">Country: </label>
                        <input type="text" name="billing[country]" id="country" class="form-control" value="<?php echo $billingAddress->country; ?>">
                    </div>
                    <div class="col-6">
                        <label for="zipcode">Zipcode: </label>
                        <input type="zipcode" name="billing[zipcode]" id="zipcode" class="form-control" value="<?php echo $billingAddress->zipcode; ?>">
                    </div>
                </div>

                <div class="row form-group form-check">
                    <div class="col-6">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="saveBillnginFlag" value="1"> Save in Address book
                        </label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <input type="button" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl('saveBilling'); ?>').load()" class="btn btn-success" value="save">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 pl-3 float-left">
            <div class="pt-3 pr-3 pl-3 border rounded">
                <h5>Shipping Address</h5>
                <hr>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="firstName">First Name: </label>
                        <input type="text" name="shipping[firstName]" id="firstName" class="form-control" value="<?php echo $shippingAddress->firstName; ?>">
                    </div>
                    <div class="col-6">
                        <label for="lastName">Last Name: </label>
                        <input type="text" name="shipping[lastName]" id="lastName" class="form-control" value="<?php echo $shippingAddress->lastName; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="address">Customer Address: </label>
                        <input type="text" name="shipping[address]" id="address" class="form-control" value="<?php echo $shippingAddress->address; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="city">City: </label>
                        <input type="text" name="shipping[city]" id="city" class="form-control" value="<?php echo $shippingAddress->city; ?>">
                    </div>
                    <div class="col-6">
                        <label for="state">State: </label>
                        <input type="text" name="shipping[state]" id="state" class="form-control" value="<?php echo $shippingAddress->state; ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="country">Country: </label>
                        <input type="text" name="shipping[country]" id="country" class="form-control" value="<?php echo $shippingAddress->country; ?>">
                    </div>
                    <div class="col-6">
                        <label for="zipcode">Zipcode: </label>
                        <input type="zipcode" name="shipping[zipcode]" id="zipcode" class="form-control" value="<?php echo $shippingAddress->zipcode; ?>">
                    </div>
                </div>

                <div class="row form-group form-check">
                    <div class="col-12">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="sameAsBilling"> Same As Billing
                        </label>

                        <label class="form-check-label ml-5">
                            <input type="checkbox" class="form-check-input" name="saveShippingFlag"> Save in Address book
                        </label>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <input type="button" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl('saveShipping'); ?>').load()" class="btn btn-success" value="save">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 pr-3 mt-4 float-left">
            <div class="pt-3 pr-3 pl-3 border rounded">
                <h5>Payment Method</h5><hr>
                <?php foreach ($paymentMethods->getData() as $paymentMethod) : ?>
                <div class="form-check pb-1">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="paymentMethod" id="paymentMethod" value="<?= $paymentMethod->methodId; ?>" <?php if($cart->paymentMethodId == $paymentMethod->methodId) { echo "checked"; } ?>><?= $paymentMethod->name; ?>
                    </label>
                </div>
                <?php endforeach; ?>

                <div class="row form-group">
                    <div class="col-6 pt-2">
                        <input type="button" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl('savePaymentMethod'); ?>').load()" class="btn btn-success" value="save">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 pl-3 mt-4 float-left">
            <div class="pt-3 pr-3 pl-3 border rounded">
                <h5>Shipping Method</h5><hr>
                <?php foreach ($shippingMethods->getData() as $shippingMethod) : ?>
                <div class="pl-3 row">
                    <div class="form-check pb-1 col-6">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="shippingMethod" id="shippingMethod" value="<?= $shippingMethod->methodId; ?>" <?php if($cart->shippingMethodId == $shippingMethod->methodId) { echo "checked"; } ?>><?= $shippingMethod->name. ' ('.$shippingMethod->description.')'; ?>
                        </label>
                    </div>
                    <div class="col-6">
                        <?= $shippingMethod->amount.' ₹'; ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="row form-group">
                    <div class="col-6 pt-2">
                        <input type="button" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl('saveShippingMethod'); ?>').load()" class="btn btn-success" value="save">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 pr-3 mt-4 float-left">
            <div class="pt-3 pr-3 pl-3 border rounded">
                <h5>Cart Summary</h5><hr>
                <div class="mb-3">Base Total: <?= $cart->getTotal().' ₹'; ?></div>
                <div class="mb-3">Shipping Amount: <?= $cart->shippingAmount.' ₹'; ?></div>
                <div class="mb-3 font-weight-bold">Grand Total: <?= ($cart->getTotal() + $cart->shippingAmount).' ₹'; ?></div>
                <a class="mb-3 btn btn-info" onclick="object.setUrl('<?= $this->getUrl('placeOrder', 'Admin\Order', ['cartId' => $cart->cartId]); ?>').load()" href="javascript:viod(0)">Place Order</a>
            </div>
        </div>
    </div>
</form>