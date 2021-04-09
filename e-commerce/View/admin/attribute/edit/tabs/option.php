<?php $options = $this->getOptions(); ?> 

<div id="title">
    <h2>
        Attribute option
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\Attribute\Option', null)}"; ?>">
    <button type="button" class="btn btn-success mr-2 float-right" onclick="object.addRow()">Add Row</button>
    <input class="btn btn-success mb-3 mr-3 float-right" onclick="object.setForm(this).load()" type="button" value="Update">
    <table class="table table-hover" id="existingOption">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Sort Order</th>
                <th>&nbsp;</th>
                
            </tr>
        </thead>
        <tbody>
        <?php if(!$options): ?>
            <tr><td colspan="3">No Record Found.</td></tr>
        <?php else : ?>
        <?php foreach($options->getData() as $key=>$option): ?>
            <?php $rowStatus = ($option->optionId) ? 'exists' : 'new' ?>
            <tr>
                <td><input type="text" name="exists[<?php echo $option->optionId; ?>][name]" class="form-control col-9" value="<?php echo $option->name ?>"></td>
                <td><input type="text" name="exists[<?php echo $option->optionId; ?>][sortOrder]" class="form-control col-9" value="<?php echo $option->sortOrder ?>"></td>
                <td><button type="button" class="btn btn-danger float-right" onclick="object.removeRow(this)" id="remove">Remove</button></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</form>

<div style="display: none;">
    <table id="newOption">
        <tbody>
            <tr>
                <td><input type="text" name="new[name][]" class="form-control col-9"></td>
                <td><input type="text" name="new[sortOrder][]" class="form-control col-9"></td>
                <td><button type="button" class="btn btn-danger float-right" onclick="object.removeRow(this)" id="remove">Remove</button></td>
            </tr>
        </tbody>
    </table>
</div>