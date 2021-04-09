<?php $configGroups = $this->getConfigGroups(); ?>

<h4>
Manage Attribue
</h4>
<hr>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load();" href="javascript:void(0);">Add Group</a><br><br>
<div id="table">
	<table class="table table-hover">
		<thead class="thead-light">
            <tr>
                <th>Group Id</th>
                <th>Name</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
		</thead>
	
		<?php if(!$configGroups): ?>
        </table> No Record Found
		<?php else : ?>
        <tbody>
		<?php foreach($configGroups->getData() as $key=>$value){ ?>
        <tr>
			<td><?php echo $value->groupId; ?></td>
			<td><?php echo $value->name; ?></td>
			<td><?php echo $value->createdDate; ?></td>
			<td><a onclick="object.setUrl('<?php echo $this->geturl('form', 'Admin\ConfigGroup', ['groupId' => $value->groupId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Update Page" class="btn btn-success"><i class="far fa-edit"></i></a>
			<a onclick="object.setUrl('<?php echo $this->geturl('delete', 'Admin\ConfigGroup', ['groupId' => $value->groupId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Delete Page" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
		<?php } ?>
		</tbody><?php endif; ?>
	</table>
</div>