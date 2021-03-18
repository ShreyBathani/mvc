<?php $customerGroups = $this->getCustomerGroups(); ?>
<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, true, true); ?>').load()" href="javascript:void(0)" title="Delete Group" class="btn btn-danger">Add Customer Group</a><br><br>
<div id="table">
  <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>Group Id</th>
        <th>Namename</th>
        <th>Status</th>
        <th>CreatedDate</th>
        <th>Action</th>
      </tr>
    </thead>
  
    <?php
    if(!$customerGroups):
      echo "</table> No Record Found.";
    else :
      echo "<tbody>";
      foreach($customerGroups->getData() as $key=>$value){
      ?>
        <tr>
            <td><?php echo $value->groupId; ?></td>
            <td><?php echo $value->name; ?></td>
            <td><?php if($value->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
            <td><?php echo $value->createdDate; ?></td>
            <td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['groupId' => $value->groupId], true); ?>').load()" href="javascript:void(0)" title="Update Group" class="btn btn-success"><i class="far fa-edit"></i></a>
            <a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['groupId' => $value->groupId], true); ?>').load()" href="javascript:void(0)" title="Delete Group" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
      <?php } ?>
    </tbody><?php endif; ?>
  </table>
</div>