<?php $categoryRow = $this->getTableRow(); ?>

<?php $categoryOptions = $this->getCategoryOptions(); ?>
</pre>
<div id="title">
    <h2>
        <?php if (!$categoryRow->categoryId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Category
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo $this->getFormUrl(); ?>">
    <div  class="ml-5">
        <div class="col-4 form-group">
            <label for="name">Name: </label>
            <input type="text" name="category[name]" id="name" class="form-control" value="<?php echo $categoryRow->name; ?>">
        </div>
        <div class="col-4 form-group">
            <label for="status">Status: </label>
            <select name="category[status]" class="form-control">
            <option value='' disabled selected></option>
            
            <?php foreach($this->getTableRow()->getStatusOptions() as $key => $value):?>
                <option value="<?php echo $key ?>" <?php if($categoryRow->status == $key){ if($categoryRow->categoryId){echo "selected";} } ?> ><?php echo $value; ?></option>  
            <?php endforeach; ?>
            
            </select>
        </div>
        <div class="col-4 form-group">
            <label for="description">Description: </label>
            <input type="text" name="category[description]" class="form-control" id="description" value="<?php echo $categoryRow->description; ?>">
        </div>
        <div class="col-4 form-group">
            <label for="parentId">Parent Path: </label>
            <select name="category[parentId]" class="form-control">
                <?php if($categoryOptions): ?>
                
                <?php foreach($categoryOptions as $categoryId => $name):?>
                    <option value="<?php echo $categoryId ?>" <?php if($categoryId == $categoryRow->parentId){ echo "selected"; } ?> ><?php echo $name; ?></option>  
                <?php endforeach; ?>
                
                <?php endif; ?>
            </select>
        </div>
        <div class="col-4 form-group">
            <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
        </div>
    </div>
</form>