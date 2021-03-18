<?php $shippingMethodRow = $this->getTableRow(); ?>

<div id="title">
    <h2>
        <?php if (!$shippingMethodRow->methodId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Shipping Method
    </h2>
</div>
<hr>

<form method="POST" id="form" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="row form-group">
            <div class="col-4">
                <label for="name">Name: </label>
                <input type="text" name="shippingMethod[name]" id="name" class="form-control" value="<?php echo $shippingMethodRow->name; ?>">
            </div>
            <div class="col-4">
                <label for="code">Code: </label>
                <input type="text" name="shippingMethod[code]" id="code" class="form-control" value="<?php echo $shippingMethodRow->code; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="amount">Amount: </label>
                <input type="text" name="shippingMethod[amount]" id="amount" class="form-control" value="<?php echo $shippingMethodRow->amount; ?>">
            </div>
            <div class="col-4">
                <label for="description">Description: </label>
                <input type="text" name="shippingMethod[description]" class="form-control" id="description" value="<?php echo $shippingMethodRow->description; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="status">Status: </label>
                <select name="shippingMethod[status]" class="form-control">
                <option value='' disabled selected></option>
                
                <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($shippingMethodRow->status == $key){ if($shippingMethodRow->methodId){echo "selected";} } ?> ><?php echo $value; ?></option>  
                <?php endforeach; ?>
                
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
            </div>
        </div>
    </div>
</form>