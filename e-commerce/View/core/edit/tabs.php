<?php $tabs = $this->getTabs(); ?>

<div class="p-2">
    <?php foreach ($tabs as $key => $tab) { ?>
        <a class="btn btn-outline-dark btn-block"  onclick="object.setUrl('<?php echo $this->getUrl(null,null, ['tab' => $key]); ?>').load()" href="javascript:void(0)" href=""><?php echo $tab['label']; ?></a>
    <?php } ?>
</div>