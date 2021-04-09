<?php $brands = $this->getBrands(); ?>
<h4><?= $this->getTitle(); ?></h4>
<hr>


<form method="POST" action="<?php echo "{$this->geturl('Update', 'Admin\Brand', null)}"; ?>" enctype="multipart/form-data">
    <div class="mb-3 float-right">
        <a onclick="object.setForm(this).load()" href="javascript:void(0)" class="btn btn-success">Update</a>
        <a onclick="object.setForm(this).setUrl('<?= $this->getUrl('delete'); ?>').load()" href="javascript:void(0)" class="btn btn-success">Delete</a>
    </div>
    <div id="table">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Brand Id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Feature</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php if($brands): ?>
            <?php foreach ($brands->getData() as $brand): ?>
                <tr>
                    <td><?= $brand->brandId; ?></td>
                    <td><img src="<?php echo 'Skin/Admin/image/brand/'.$brand->imageName ?>" alt="brand" width="75" height="75"></td>
                    <td><input type="text" name="brand[name][<?php echo $brand->brandId ?>]" class="form-control col-9" id="name" value="<?php echo $brand->name ?>"></td>
                    <td><input type="checkbox" name="brand[feature][]" value="<?php echo $brand->brandId ?>" id="feature" <?php if($brand->feature == 1){echo 'checked';}?>></td>
                    <td><input type="checkbox" name="brand[remove][]" value="<?php echo $brand->brandId ?>" class="form-check-control" id="remove"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <?php else: ?>
                <tr><td>No Records Found.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div>
        <div class="row form-group">
            <div class="col-4">
                <label for="image">Image: </label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
        </div>
        <div class="col-4">
            <input type="button" class="btn btn-success" onclick="object.setForm(this).setUrl('<?php echo $this->geturl('uploadImage', null); ?>').uploadFile()" value="Upload">
        </div>
    </div>
</form>