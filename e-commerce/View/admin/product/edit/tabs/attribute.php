<?php $attributes = $this->getAttributes();  ?>
<?php $product = $this->getTableRow(); ?>
<div id="title">
    <h2>
        Product Attribute
    </h2>
</div>
<hr>


<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\product\attribute')}"; ?>">
    <?php if ($attributes): ?>
        <?php foreach($attributes->getData() as $attribute): ?>
        <?php
            $displayBlock = \Mage::getBlock('Block\Admin\Attribute\Display');
            $displayBlock->setAttribute($attribute)->setProduct($product);
            echo $displayBlock->toHtml();
        ?>
        <?php endforeach; ?>
    <?php else: ?>
    <div  class="ml-5">
        Attributes Not Avaiable for this Product.
    </div>
    <?php endif; ?>
    <div class="row form-group">
        <div class="col-4">
            <input type="button" onclick="object.setForm(this).load()" name="submit" class="btn btn-success" id="submit" value="save">
        </div>
    </div>
</form>