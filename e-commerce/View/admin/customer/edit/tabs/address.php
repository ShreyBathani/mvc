<?php $billing = $this->getBilling(); ?>
<?php $shipping = $this->getShipping(); ?>

<form method="POST" action="<?php echo $this->getFormUrl(); ?>">

    <div id="title">
        <h2>
            Billing Address
        </h2>
    </div>
    <hr>

    <div class="ml-5">
        <div class="row form-group">
            <div class="col-6">
                <label for="address">Customer Address: </label>
                <input type="text" name="billing[address]" id="address" class="form-control" value="<?php echo $billing->address; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-3">
                <label for="city">City: </label>
                <input type="text" name="billing[city]" id="city"class="form-control"  value="<?php echo $billing->city; ?>">
            </div>
            <div class="col-3">
                <label for="state">State: </label>
                <input type="text" name="billing[state]" id="state" class="form-control" value="<?php echo $billing->state; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-3">
                <label for="country">Country: </label>
                <input type="text" name="billing[country]" id="country" class="form-control" value="<?php echo $billing->country; ?>">
            </div>
            <div class="col-3">
                <label for="zipcode">Zipcode: </label>
                <input type="zipcode" name="billing[zipcode]" id="zipcode" class="form-control" value="<?php echo $billing->zipcode; ?>">
            </div>
        </div>
    </div>


    <div id="title" class="mt-3">
        <h2>
            Shipping Address
        </h2>
    </div>
    <hr>

    <div class="ml-5">
        <div class="row form-group">
            <div class="col-6">
                <label for="address">Customer Address: </label>
                <input type="text" name="shipping[address]" id="address" class="form-control" value="<?php echo $shipping->address; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-3">
                <label for="city">City: </label>
                <input type="text" name="shipping[city]" id="city"class="form-control"  value="<?php echo $shipping->city; ?>">
            </div>
            <div class="col-3">
                <label for="state">State: </label>
                <input type="text" name="shipping[state]" id="state" class="form-control" value="<?php echo $shipping->state; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-3">
                <label for="country">Country: </label>
                <input type="text" name="shipping[country]" id="country" class="form-control" value="<?php echo $shipping->country; ?>">
            </div>
            <div class="col-3">
                <label for="zipcode">Zipcode: </label>
                <input type="zipcode" name="shipping[zipcode]" id="zipcode" class="form-control" value="<?php echo $shipping->zipcode; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3">
                <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
            </div>
        </div>
    </div>
</form>