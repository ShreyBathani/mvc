<?php $media = $this->getMedia(); ?> 

<div id="title">
    <h2>
        Media
    </h2>
</div>

<hr>

        
<form method="POST" action="<?php echo "{$this->geturl('saveMedia', 'Admin\Product\Media', null)}"; ?>" enctype="multipart/form-data">
    <input class="btn btn-success mb-3 float-right" type="button" onclick="object.setForm(this).setUrl('<?php echo $this->geturl('deleteMedia', 'Admin\Product\Media', null); ?>').load()"  value="Delete">
    <input class="btn btn-success mb-3 mr-3 float-right" onclick="object.setForm(this).load()" type="button" value="Update">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>Image</th>
                <th>Label</th>
                <th>Small</th>
                <th>Thumb</th>
                <th>Base</th>
                <th>Gallery</th>
                <th>Remove</th>
            </tr>
        </thead>
        <?php
        if(!$media):
            echo "</table> No Record Found.";
        else :
            echo "<tbody>";
            foreach($media->getData() as $key=>$value)
            {?>
                <tr>
                    <td><img src="<?php echo 'Skin/Admin/image/product/'.$value->imageName ?>" width="75" height="75" ></td>
                    <td><input type="text" name="media[label][<?php echo $value->imageId ?>]" class="form-control col-9" id="label" value="<?php echo $value->label ?>"></td>
                    <td><input type="radio" name="media[small][]" value="<?php echo $value->imageId ?>" id="small" <?php if($value->small == 1){echo 'checked';}?>></td>
                    <td><input type="radio" name="media[thumb][]" value="<?php echo $value->imageId ?>" id="thumb" <?php if($value->thumb == 1){echo 'checked';}?>></td>
                    <td><input type="radio" name="media[base][]" value="<?php echo $value->imageId ?>" id="base" <?php if($value->base == 1){echo 'checked';}?>></td>
                    <td><input type="checkbox" name="media[gallery][]" value="<?php echo $value->imageId ?>" class="form-check-control" id="gallery" <?php if($value->gallery == 1){echo 'checked';}?>></td>
                    <td><input type="checkbox" name="media[remove][]" value="<?php echo $value->imageId ?>" class="form-check-control" id="remove"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table><?php endif; ?>
<!-- </form> -->

<hr>
    <div id="title">
        <h2>
            Upload Image
        </h2>
    </div>
<hr>
<!-- <form method="POST" action="<?php //echo "{$this->geturl('saveMedia', 'Product_Media', null)}"; ?>" enctype="multipart/form-data"> -->
    <div  class="ml-5">
        <div class="row form-group">
            <div class="col-4">
                <label for="image">Image: </label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
        </div>
        <div class="col-4">
            <input type="button" class="btn btn-success" onclick="object.setForm(this).setUrl('<?php echo $this->geturl('uploadImage', 'Admin\Product\Media', null); ?>').uploadFile()" value="Upload">
        </div>
    </div>
</form>