<?php $attributeRow = $this->getTableRow(); ?>

<div id="title">
    <h2>
        <?php if (!$attributeRow->attributeId):?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Attribute
    </h2>
</div>
<hr>

<div class="ml-5">
    <form method="POST" action="<?php echo "{$this->geturl("save", null, null, false)}"; ?>">
        <div class="row form-group">
            <div class="col-4">
                <label for="entityTypeId">Entity Type: </label>
                <select name="attribute[entityTypeId]" class="form-control">
                <option value='' disabled selected></option>
                
                <?php foreach ($this->getTableRow()->getEntityTypeOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($attributeRow->entityTypeId == $key){ echo "selected"; } ?> ><?php echo $value; ?></option>  
                <?php endforeach;?>

                </select>
            </div>
            <div class="col-4">
                <label for="name">Name: </label>
                <input type="text" name="attribute[name]" id="name" class="form-control" value="<?php echo $attributeRow->name; ?>">
            </div>
            
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="code">Code: </label>
                <input type="text" name="attribute[code]" id="code" class="form-control" value="<?php echo $attributeRow->code; ?>">
            </div>
            <div class="col-4">
                <label for="inputType">Input Type: </label>
                <select name="attribute[inputType]" class="form-control">
                <option value='' disabled selected></option>
                
                <?php foreach ($this->getTableRow()->getInputTypeOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($attributeRow->inputType == $key){ echo "selected"; } ?> ><?php echo $value; ?></option>  
                <?php endforeach;?>
                
                </select>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="backendType">Backend Type: </label>
                <select name="attribute[backendType]" class="form-control">
                <option value='' disabled selected></option>

                <?php foreach ($this->getTableRow()->getBackendTypeOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($attributeRow->backendType == $key){ echo "selected"; } ?> ><?php echo $value; ?></option>  
                <?php endforeach;?>
   
                </select>
            </div>
            <div class="col-4">
                <label for="sortOrder">Sort Order: </label>
                <input type="text" name="attribute[sortOrder]" id="sortOrder" class="form-control" value="<?php echo $attributeRow->sortOrder; ?>">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-4">
                <label for="backendModel">Backend Model: </label>
                <input type="text" name="attribute[backendModel]" id="backendModel" class="form-control" value="<?php echo $attributeRow->backendModel; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
            </div>
        </div>
    </form>
</div>