<?php $configurations = $this->getconfigurations(); ?>

<div id="title">
    <h2>
        Configuration
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\ConfigGroup\Configuration', null)}"; ?>">
    <button type="button" class="btn btn-success mr-2 float-right" onclick="object.addRow()">Add Row</button>
    <input class="btn btn-success mb-3 mr-3 float-right" onclick="object.setForm(this).load()" type="button" value="Update">
    <table class="table table-hover" id="existingOption">
        <thead class="thead-light">
            <tr>
                <th>Title</th>
                <th>Code</th>
                <th>Value</th>
                <th>&nbsp;</th> 
            </tr>
        </thead>
        <tbody>
        <?php if(!$configurations): ?>
            <tr><td colspan="4">No Record Found.</td></tr>
        <?php else : ?>
        <?php foreach($configurations->getData() as $configuration): ?>
            <?php $rowStatus = ($configuration->configId) ? 'exists' : 'new' ?>
            <tr>
                <td><input type="text" name="exists[<?php echo $configuration->configId; ?>][title]" class="form-control col-9" value="<?php echo $configuration->title ?>"></td>
                <td><input type="text" name="exists[<?php echo $configuration->configId; ?>][code]" class="form-control col-9" value="<?php echo $configuration->code ?>"></td>
                <td><input type="text" name="exists[<?php echo $configuration->configId; ?>][value]" class="form-control col-9" value="<?php echo $configuration->value ?>"></td>
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
                <td><input type="text" name="new[title][]" class="form-control col-9"></td>
                <td><input type="text" name="new[code][]" class="form-control col-9"></td>
                <td><input type="text" name="new[value][]" class="form-control col-9"></td>
                <td><button type="button" class="btn btn-danger float-right" onclick="object.removeRow(this)" id="remove">Remove</button></td>
            </tr>
        </tbody>
    </table>
</div>