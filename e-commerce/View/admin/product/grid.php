<?php $products = $this->getProducts(); ?>

<h4>
    Manage Product
</h4>
<hr>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form', null, null, true); ?>').load()" href="javascript:void(0)">Add Product</a><br><br>
<div id="table">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Product Id</th>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>

        <?php
        if (!$products) :
            echo "</table> No Record Found.";
        else :
            echo "<tbody>";
            foreach ($products->getData() as $key => $value) {
        ?>
                <tr>
                    <td><?php echo $value->productId; ?></td>
                    <td><?php echo $value->sku; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->price; ?></td>
                    <td><?php echo $value->discount; ?></td>
                    <td><?php echo $value->quantity; ?></td>
                    <td><?php if ($value->status == 0) {
                            echo "Disabled";
                        } else {
                            echo "Enabled";
                        } ?></td>
                    <td><?php echo $value->createdDate; ?></td>
                    <td><?php echo $value->updatedDate; ?></td>
                    <td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['productId' => $value->productId], true); ?>').resetParams().load()" href="javascript:void(0)" title="Update Contact" class="btn btn-success"><i class="far fa-edit"></i></a></td>
                    <td><a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['productId' => $value->productId], true); ?>').resetParams().load()" href="javascript:void(0)" title="Delete Product" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                    <td><a onclick="object.setUrl('<?php echo $this->geturl('addToCart', 'Admin\Cart', ['productId' => $value->productId], true); ?>').resetParams().load()" href="javascript:void(0)" title="Add to cart" class="btn btn-info"><i class="fas fa fa-shopping-cart"></i></a></td>
                </tr>
            <?php } ?>
            </tbody><?php endif; ?>
    </table>
</div>