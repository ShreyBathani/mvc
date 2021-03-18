<?php $categories = $this->getCategories(); ?>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->geturl('form',  null, null, true); ?>').resetParams().load();" href="javascript:void(0);">Add Category</a><br><br>
<div id="table">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Category Id</th>
                <th>Name</th>
                <th>status</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!$categories): ?>
            <tr>
                <td colspan="5">No records Found</td>
            </tr>
        <?php else: ?>
        <?php foreach ($categories->getData() as $category): ?>
            <tr>
                <td><?php echo $category->categoryId; ?></td>
                <td><?php echo $this->getName($category); ?></td>
                <td><?php if($category->status == 0){echo "Disabled";} else {echo "Enabled"; } ?></td>
                <td><?php echo $category->description; ?></td>
                <td><a onclick="object.setUrl('<?php echo $this->geturl('form', null, ['categoryId' => $category->categoryId], true); ?>').resetParams().load();" href="javascript:void(0);" title="Update Category" class="btn btn-success edit-icon"><i class="far fa-edit"></i></a>
                <a onclick="object.setUrl('<?php echo $this->geturl('delete', null, ['categoryId' => $category->categoryId], true); ?>').resetParams().load()" href="javascript:void(0);" title="Delete Category" class="btn btn-danger del-icon"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>