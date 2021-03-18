<?php $customerRow = $this->getTableRow(); ?>
<?php $customerGroups = $this->getCustomerGroups(); ?>

<div id="title">
    <h2>
        <?php if (!$customerRow->customerId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Customer
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="row form-group">
            <div class="col-4">
                <label for="group">Group: </label>
                <select name="customer[groupId]" class="form-control">
                <option value='' disabled selected></option>

                <?php if($customerGroups): ?>
                    <?php foreach ($customerGroups->getData() as $key => $value): ?>
                        <option value="<?php echo $value->groupId ?>" <?php if($customerRow->groupId == $value->groupId){ echo "selected";} ?>><?php echo $value->name ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value='' disabled>No groups Available</option>
                <?php endif; ?>

                </select>
            </div>
            <div class="col-4">
                <label for="firstName">First Name: </label>
                <input type="text" name="customer[firstName]" id="firstName" class="form-control" value="<?php echo $customerRow->firstName; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="lastName">Last Name: </label>
                <input type="text" name="customer[lastName]" id="lastName" class="form-control" value="<?php echo $customerRow->lastName; ?>">
            </div>
            <div class="col-4">
                <label for="email">Email: </label>
                <input type="email" name="customer[email]" id="email"class="form-control"  value="<?php echo $customerRow->email; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="password">Password: </label>
                <input type="password" name="customer[password]" id="password" class="form-control" value="<?php echo $customerRow->password; ?>">
            </div>
            <div class="col-4">
                <label for="phone">Phone: </label>
                <input type="phone" name="customer[phone]" id="phone" class="form-control" value="<?php echo $customerRow->phone; ?>">
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col-4">
                <label for="status">Status: </label>
                <select name="customer[status]" class="form-control">
                <option value='' disabled selected></option>

                <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($customerRow->status == $key){ if($customerRow->customerId){echo "selected";} } ?>><?php echo $value ?></option>
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