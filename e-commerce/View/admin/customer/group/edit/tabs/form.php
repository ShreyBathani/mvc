<?php $customerGroupRow = $this->getTableRow(); ?>

<div id="title">
    <h2>
        <?php if (!$customerGroupRow->groupId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Customer Group
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo "{$this->geturl("save", null, null, false)}"; ?>">
    <div class="ml-5">
        <div class="col-4 form-group">
            <label for="name">Name: </label>
            <input type="text" name="customerGroup[name]" id="name" class="form-control" value="<?php echo $customerGroupRow->name; ?>">
        </div>
        <div class="col-4 form-group">
            <label for="status">Status: </label>
            <select name="customerGroup[status]" class="form-control">
            <option value='' disabled selected></option>
            
            <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                <option value="<?php echo $key ?>" <?php if($customerGroupRow->status == $key){ if($customerGroupRow->groupId){echo "selected";} } ?> ><?php echo $value; ?></option>  
            <?php endforeach; ?>

            </select>
        </div>
        <div class="col-4 form-group">
            <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
        </div>
    </div>
</form>