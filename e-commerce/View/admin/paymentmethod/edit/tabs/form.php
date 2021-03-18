<?php $paymentMethodRow = $this->getTableRow(); ?>

<div id="title">
    <h2>
        <?php if (!$paymentMethodRow->methodId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Payment Method
    </h2>
</div>
<hr>

<form method="POST" id="form" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="row form-group">
            <div class="col-4">
                <label for="name">Name: </label>
                <input type="text" name="paymentMethod[name]" id="name" class="form-control" value="<?php echo $paymentMethodRow->name; ?>">
            </div>
            <div class="col-4">
                <label for="code">Code: </label>
                <input type="text" name="paymentMethod[code]" id="code" class="form-control" value="<?php echo $paymentMethodRow->code; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="description">Description: </label>
                <input type="text" name="paymentMethod[description]" class="form-control" id="description" value="<?php echo $paymentMethodRow->description; ?>">
            </div>
            <div class="col-4">
                <label for="status">Status: </label>
                <select name="paymentMethod[status]" class="form-control">
                <option value='' disabled selected></option>
                
                <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($paymentMethodRow->status == $key){ if($paymentMethodRow->methodId){echo "selected";} } ?> ><?php echo $value; ?></option>  
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