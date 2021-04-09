<?php $adminRow = $this->getTableRow(); ?>

<div id="title">
    <h2>
        <?php if (!$adminRow->adminId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Admin
    </h2>
</div>
<hr>

<form method="POST" id="form" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="col-4 form-group">
            <label for="password">Password: </label>
            <input type="text" name="admin[userName]" id="userName" class="form-control" value="<?php echo $adminRow->userName; ?>">
        </div>

        <div class="col-4 form-group">
            <label for="password">Password: </label>
            <input type="password" name="admin[password]" class="form-control" id="password" value="<?php echo $adminRow->password; ?>">
        </div>

        <div class="col-4 form-group">
            <label for="status">Status: </label>
            <select name="admin[status]" class="form-control">
            <option value='' disabled selected></option>

            <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                <option value="<?php echo $key ?>" <?php if($adminRow->status == $key){ if($adminRow->adminId){echo "selected";} } ?> ><?php echo $value; ?></option>  
            <?php endforeach; ?>

            </select>
        </div>
        
        <div class="col-4 form-group">
            <input type="button" onclick="object.setForm(this).load()" value="save" class="btn btn-success" id="submit">
        </div>
    </div>
</form>