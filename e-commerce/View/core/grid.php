<?php $collection = $this->getCollection(); ?>
<?php $columns = $this->getColumns(); ?>
<?php $buttons = $this->getButtons(); ?>
<?php $actions = $this->getActions(); ?>
<?php $model = $this->getModel(); ?>

<h4>
<?php echo $this->getTitle(); ?>
</h4>
<hr>

<form method="POST" action="<?php echo $this->geturl("filter"); ?>">
	<div class="mb-3">
		<?php if($buttons): ?>
			<?php foreach ($buttons as $key => $button): ?>
				<?php if($button['ajax']): ?>
					<a onclick="object.setUrl('<?= $this->getButtonUrl($button['method']); ?>').resetParams().load()" href="javascript:void(0)" class="<?= $button['class']; ?>"><?= $button['label']; ?></a>
				<?php else: ?>
					<a href="<?= $this->getButtonUrl($button['method']); ?>" class="<?= $button['class']; ?>"><?= $button['label']; ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
			<input type="button" onclick="object.setForm(this).load()" class="btn btn-success ml-2" value="Apply Filter">
		<?php endif; ?>
	</div>

	<div id="table">
		<table class="table table-hover">
			<thead class="thead-light">
			<tr>
				<?php if($columns): ?>
					<?php foreach ($columns as $key => $column): ?>
						<th><?= $column['label'] ?></th>
					<?php endforeach; ?>
				<?php endif; ?>
				
				<?php if($actions): ?>
					<th>Action</th>
				<?php endif; ?>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php if ($columns) : ?>
					<?php foreach ($columns as $key => $column) : ?>
						<td><input type="text" name="filters[<?php echo $column['type']; ?>][<?php echo $column['field']; ?>]" placeholder="Search" value="<?= $this->getFilter()->getFilterValue($column['type'], $column['field']); ?>" class="form-control"></td>
					<?php endforeach; ?>
					<td></td>
				<?php endif; ?>
			</tr>
			<?php if($collection): ?>
				<?php foreach($collection->getData() as $row): ?>
					<tr>
						<?php foreach ($columns as $key => $column): ?>
							<td>
								<?php if($column['field'] == 'status'): ?>
									<?php if($this->getFieldValue($row, $column['field']) == 1): ?>
										<?= 'Enabled'; ?>
									<?php else: ?>
										<?= 'Disabled'; ?>
									<?php endif; ?>
								<?php continue; ?>
								<?php endif; ?>
								<?= $this->getFieldValue($row, $column['field']); ?>
							</td>
						<?php endforeach; ?>
						<td>
							<?php if($actions): ?>
								<?php foreach ($actions as $key => $action): ?>
									<?php if($action['ajax']): ?>
										<a onclick="object.setUrl('<?= $this->getMethodUrl($row, $action['method']); ?>').resetParams().load()" href="javascript:void(0)" class="<?= $action['class']; ?>"><?= $action['label']; ?></a>
									<?php else: ?>
										<a href="<?= $this->getMethodUrl($row, $action['method']); ?>" class="<?= $action['class']; ?>"><?= $action['label']; ?></a>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr><td>No Records Found.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</form>