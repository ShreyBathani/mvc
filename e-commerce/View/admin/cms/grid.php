<?php $cms = $this->getCms(); ?>

<h4>
Manage Cms
</h4>
<hr>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load();" href="javascript:void(0);">Add Page</a><br><br>
<div id="table">
	<table class="table table-hover">
		<thead class="thead-light">
		<tr>
			<th>Page Id</th>
			<th>Title</th>
			<th>Identifier</th>
			<th>Content</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Action</th>
		</tr>
		</thead>
	
		<?php if(!$cms): ?>
        </table> No Record Found
		<?php else : ?>
        <tbody>
		<?php foreach($cms->getData() as $key=>$value){ ?>
        <tr>
			<td><?php echo $value->pageId; ?></td>
			<td><?php echo $value->title; ?></td>
			<td><?php echo $value->identifier; ?></td>
			<td><?php echo $value->content; ?></td>
			<td><?php if($value->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
			<td><?php echo $value->createdDate; ?></td>
			<td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['pageId' => $value->pageId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Update Page" class="btn btn-success"><i class="far fa-edit"></i></a>
			<a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['pageId' => $value->pageId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Delete Page" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
		<?php } ?>
		</tbody><?php endif; ?>
	</table>
</div>