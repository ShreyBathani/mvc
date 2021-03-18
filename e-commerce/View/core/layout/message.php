<div id="message" class="pb-2">
    <?php if($success = $this->getMessage()->getSuccess()):
            $this->getMessage()->unsetSuccess(); ?>
            <div class="alert alert-success alert-dismissible fade show col-4 mb-0">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $success; ?>
            </div>
    <?php endif; ?>

    <?php if($failure = $this->getMessage()->getFailure()):
            $this->getMessage()->unsetFailure(); ?>
            <div class="alert alert-danger alert-dismissible fade show col-4 mb-0">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $failure; ?>
            </div>
    <?php endif; ?>
</div>