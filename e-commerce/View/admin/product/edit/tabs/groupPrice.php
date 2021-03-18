<?php $product= $this->getTableRow(); ?>
<?php $customerGroups = $this->getCustomerGroups(); ?>

<div id="title">
    <h2>
        Group Price
    </h2>
</div>

<hr>

<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\Product\GroupPrice', null)}"; ?>">
    <input class="btn btn-success mb-3 mr-3 float-right" onclick="object.setForm(this).load()" type="button" value="Update">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Group Id</th>
                <th>Group Name</th>
                <th>Price</th>
                <th>Group Price</th>
            </tr>
        </thead>
        <?php
        if(!$customerGroups):
            echo "</table> Customer Groups Not Available.";
        else :
            echo "<tbody>";
            foreach($customerGroups->getData() as $key=>$customerGroup): ?>
            <?php $rowStatus = ($customerGroup->entityId) ? 'exists' : 'new' ?>
                <tr>
                    <td><?php echo $customerGroup->groupId; ?></td>
                    <td><?php echo $customerGroup->name ?></td>
                    <td><?php echo $customerGroup->price ?></td>
                    <td><input type="text" name="groupPrice[<?php echo $rowStatus ?>][<?php echo $customerGroup->groupId ?>]" class="form-control col-9" id="groupPrice" value="<?php echo $customerGroup->groupPrice ?>"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><?php endif; ?>
</form>