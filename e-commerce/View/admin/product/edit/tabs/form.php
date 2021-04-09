<?php $productRow = $this->getTableRow(); ?>
<?php $categoryOptions = $this->getCategoryOptions(); ?>
<?php $selectedCategory = $this->getSelectedCategory(); ?>

<div id="title">
    <h2>
        <?php if (!$productRow->productId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Product
    </h2>
</div>
<hr>

<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\product', null)}"; ?>" enctype="multipart/form-data">
    <div  class="ml-5">
        <div class="row form-group">
            <div class="col-4">
                <label for="sku">SKU: </label>
                <input type="text" name="product[sku]" class="form-control" id="sku" value="<?php echo $productRow->sku; ?>">
            </div>
            <div class="col-4">
                <label for="name">Name: </label>
                <input type="text" name="product[name]" class="form-control" id="name" value="<?php echo $productRow->name; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="price">Price: </label>
                <input type="text" name="product[price]" class="form-control" id="price" value="<?php echo $productRow->price; ?>">
            </div>
            <div class="col-4">
                <label for="discount">Discount: </label>
                <input type="text" name="product[discount]" class="form-control" id="discount" value="<?php echo $productRow->discount; ?>">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="quantity">Quantity: </label>
                <input type="number" name="product[quantity]" class="form-control" id="quantity" value="<?php echo $productRow->quantity; ?>">
            </div>
            <div class="col-4">
                <label for="status">Status: </label>
                <select name="product[status]" class="form-control">
                <option value='' disabled selected></option>
                
                <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                    <option value="<?php echo $key ?>" <?php if($productRow->status == $key){ if($productRow->productId){echo "selected";} } ?> ><?php echo $value; ?></option>  
                <?php endforeach; ?>

                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <label for="description">Description: </label>
                <textarea name="product[description]" class="form-control" id="description" rows="4"><?php echo $productRow->description; ?></textarea>
            </div>
            <div class="col-4">
                <label for="category">Category: </label>
                <select name="product[category][]" class="form-control" multiple>
                
                <?php foreach ($categoryOptions as $id => $category): ?>
                    <option value="<?php echo $id ?>" <?php if(in_array($id, $selectedCategory)) { echo "selected"; } ?> ><?php echo $category; ?></option>  
                <?php endforeach; ?>

                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-4">
                <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
            </div>
        </div>
    </div>
</form>