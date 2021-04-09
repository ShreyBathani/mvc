<?php $configGroup = $this->getTableRow(); ?>

<div id="title">
    <h2>
       <?php if (!$configGroup->groupId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Group
    </h2>
</div>
<hr>

<form method="POST" id="form" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="col-4 form-group">
            <label for="title">Title: </label>
            <input type="text" name="configGroup[name]" id="name" class="form-control" value="<?php echo $configGroup->name; ?>">
        </div>
    </div>
    <div class="ml-5">
        <div class="col-4 form-group">
            <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
        </div>
    </div>
</form>