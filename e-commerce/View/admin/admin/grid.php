<?php $admins = $this->getAdmins(); ?>
<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load();" href="javascript:void(0);">Add Admin</a><br><br>
<div id="table">
	<table class="table table-hover">
		<thead class="thead-light">
		<tr>
			<th>Admin Id</th>
			<th>Username</th>
			<th>Password</th>
			<th>Status</th>
			<th>CreatedDate</th>
			<th>Action</th>
		</tr>
		</thead>
	
		<?php
		if(!$admins):
		echo "</table> No Record Found.";
		else :
		echo "<tbody>";
		foreach($admins->getData() as $key=>$value){
		?>
			<tr>
			<td><?php echo $value->adminId; ?></td>
			<td><?php echo $value->userName; ?></td>
			<td><?php echo $value->password; ?></td>
			<td><?php if($value->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
			<td><?php echo $value->createdDate; ?></td>
			<td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['adminId' => $value->adminId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Update Admin" class="btn btn-success"><i class="far fa-edit"></i></a>
			<a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['adminId' => $value->adminId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Delete Admin" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
			</tr>
		<?php } ?>
		</tbody><?php endif; ?>
	</table>
</div>