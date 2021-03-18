<?php $customers = $this->getCustomers(); ?>
<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load();" href="javascript:void(0);">Add Customer</a><br><br>
<div id="table">
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th>Customer Id</th>
            <th>Group Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Status</th>
            <th>zipcode</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>

        <?php
        if(!$customers):
            echo "</table> No Record Found.";
        else :
        echo "<tbody>";
            foreach($customers->getData() as $key=>$value){
            ?>
                <tr>
                <td><?php echo $value->customerId; ?></td>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->firstName; ?></td>
                <td><?php echo $value->lastName; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $value->password; ?></td>
                <td><?php echo $value->phone; ?></td>
                <td><?php if($value->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
                <td><?php echo $value->zipcode; ?></td>
                <td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['customerId' => $value->customerId], true); ?>').load()" href="javascript:viod(0)" title="Update Customer" class="btn btn-success"><i class="far fa-edit"></i></a></td>
                <td><a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['customerId' => $value->customerId], true); ?>').load()" href="javascript:viod(0)" title="Delete Customer" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            <?php } ?>
        </tbody><?php endif; ?>
    </table>
</div>