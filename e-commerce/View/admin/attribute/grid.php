<?php $attributes = $this->getAttributes(); ?>

<h4>
Manage Attribue
</h4>
<hr>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load();" href="javascript:void(0);">Add Attribute</a><br><br>
<div id="table">
	<table class="table table-hover">
		<thead class="thead-light">
		<tr>
			<th>Attribute Id</th>
			<th>Name</th>
			<th>Entity Type Id</th>
			<th>Code</th>
			<th>Input Type</th>
			<th>Backend Type</th>
			<th>Sort Order</th>
			<th>Backend Model</th>
			<th>Action</th>
		</tr>
		</thead>
	
		<?php
		if(!$attributes):
	    echo "</table> No Record Found.";
		else :
		echo "<tbody>";
		foreach($attributes->getData() as $key=>$attribute){
		?>
			<tr>
			<td><?php echo $attribute->attributeId; ?></td>
			<td><?php echo $attribute->name; ?></td>
			<td><?php echo $attribute->entityTypeId; ?></td>
			<td><?php echo $attribute->code; ?></td>
			<td><?php echo $attribute->inputType; ?></td>
			<td><?php echo $attribute->backendType; ?></td>
			<td><?php echo $attribute->sortOrder; ?></td>
			<td><?php echo $attribute->backendModel; ?></td>
			<td><a onclick="object.setUrl('<?php echo $this->geturl('form', 'Admin\attribute', ['attributeId' => $attribute->attributeId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Update Admin" class="btn btn-success"><i class="far fa-edit"></i></a>
			<a onclick="object.setUrl('<?php echo $this->geturl('delete', 'Admin\attribute', ['attributeId' => $attribute->attributeId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Delete Admin" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
			</tr>
		<?php } ?>
		</tbody><?php endif; ?>
	</table>
</div>