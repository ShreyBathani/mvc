<?php $cartItems = $this->getCart()->getItems(); ?>
<?php $cart = $this->getCart() ?>
<?php $customers = $this->getCustomers() ?>

<h3>Cart</h3>
<hr>


<form action="<?= $this->getUrl('Update', null, null, true); ?>" method="POST" id="form">

    <a class="btn btn-success mb-3 ml-3 float-right" onclick="object.setUrl('<?php echo $this->getUrl('grid', 'Admin\Product', null, true); ?>').load();" href="javascript:void(0);">Back to Product</a>
    <a class="btn btn-success float-right" onclick="object.setForm(this).load();" href="javascript:void(0);">Update</a>
    <!-- <input class="btn btn-success float-right" type="submit" value="Update"> -->
    <div class="form-row">
        <div>
            <label class="font-weight-bold mt-2">Select Customer: </label>
        </div>
        <div class="col-4">
            <select class="form-control" name="customer">
                <option disabled selected>Select</option>
                <?php foreach ($customers->getData() as $key => $customer) : ?>
                    <option value="<?php echo $customer->customerId; ?>" <?php if ($customer->customerId == $this->getCart()->customerId) : ?>selected <?php endif; ?>><?php echo $customer->firstName. " " .$customer->lastName; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
            <input type="button" class="btn btn-secondary col-1" onclick="object.setForm(this).setUrl('<?php echo $this->getUrl('selectCustomer') ?>').load()" value="Go">
    </div>

    <div id="table">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Item ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Base-Price</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($cartItems) : ?>
                    <?php foreach ($cartItems->getData() as $key => $item): ?>
                        <tr>
                            <td> <?php echo $item->cartItemId ?> </td>
                            <td> <?php echo $item->productId ?> </td>
                            <td> <input class="form-control col-6" type="number" name="quantity[<?= $item->cartItemId ?>]" id="quantity" value="<?= $item->quantity; ?>"> </td>
                            <td> <?php echo $item->basePrice; ?> </td>
                            <td> <input class="form-control col-6" type="text" name="price[<?php  echo $item->cartItemId; ?>]" id="price" value="<?php echo $item->price; ?>"></td>
                            <td> <?php echo $item->discount * $item->quantity; ?> </td>
                            <td> <?php echo ($item->quantity * $item->price) - ($item->quantity * $item->discount); ?> </td>
                            <td>
                                <a class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl('delete', null, ['cartItemId' => $item->cartItemId]); ?>').load()" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="bg-light">
                        <td colspan="5"></td>
                        <td> <strong>Cart Total:</strong> </td>
                        <td><strong><?= $cart->getTotal()." ₹"; ?></strong></td>
                        <td></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td colspan="8">Cart is Empty !</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($cartItems) : ?>
        <a class="btn btn-info float-right" onclick="object.setUrl('<?php echo $this->getUrl('index', 'Admin\Cart\Checkout', null, true); ?>').load()" href="javascript:void(0);">Procced To Checkout</a>
        <?php endif; ?>
    </div>
</form>