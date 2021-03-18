<?php $shippingMethods = $this->getShippingMethods(); ?>
<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load()" href="javascript:void(0)">Add Shipping Method</a><br><br>
<div id="table">
  <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>Method Id</th>
        <th>Name</th>
        <th>Code</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Status</th>
        <th>CreatedDate</th>
        <th>Action</th>
      </tr>
    </thead>

    <?php
    if(!$shippingMethods):
      echo "</table> No Record Found.";
    else :
      echo "<tbody>";
      foreach($shippingMethods->getData() as $key=>$value){
      ?>
        <tr>
          <td><?php echo $value->methodId; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><?php echo $value->code; ?></td>
          <td><?php echo $value->amount; ?></td>
          <td><?php echo $value->description; ?></td>
          <td><?php if($value->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
          <td><?php echo $value->createdDate; ?></td>
          <td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['methodId' => $value->methodId], true); ?>').load()" href="javascript:void(0)" title="Update Method" class="btn btn-success"><i class="far fa-edit"></i></a>
          <a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['methodId' => $value->methodId], true); ?>').load()" href="javascript:void(0)" title="Delete Method" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
          </tr>
      <?php } ?>
    </tbody><?php endif; ?>
  </table>
</div>