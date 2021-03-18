<?php $cms = $this->getTableRow(); ?>

<div id="title">
    <h2>
       <?php if (!$cms->pageId): ?>
            Add
        <?php else: ?>
            Update
        <?php endif; ?>
        Page
    </h2>
</div>
<hr>

<form method="POST" id="form" action="<?php echo $this->getFormUrl(); ?>">
    <div class="ml-5">
        <div class="col-4 form-group">
            <label for="title">Title: </label>
            <input type="text" name="cms[title]" id="title" class="form-control" value="<?php echo $cms->title; ?>">
        </div>
        <div class="col-4 form-group">
            <label for="identifier">Identifier: </label>
            <input type="text" name="cms[identifier]" class="form-control" id="identifier" value="<?php echo $cms->identifier; ?>">
        </div>
        <div class="col-4 form-group">
            <label for="status">Status: </label>
            <select name="cms[status]" class="form-control">
            <option value='' disabled selected></option>
            
            <?php foreach ($this->getTableRow()->getStatusOptions() as $key => $value): ?>
                <option value="<?php echo $key ?>" <?php if($cms->status == $key){ if($cms->pageId){echo "selected";} } ?>><?php echo $value ?></option>
            <?php endforeach; ?>
            
            </select>
        </div>
        <div class="col-8 form-group">
            <label for="content">Content: </label>
            <textarea class="form-control" rows="5" name="cms[content]"><?php echo $cms->content; ?></textarea>
        </div>
        <div class="col-4 form-group">
            <button type="button" onclick="object.setCms().load()" name="save" class="btn btn-success">save</button>
        </div>
    </div>
</form>

<script>

CKEDITOR.replace('cms[content]');

</script>