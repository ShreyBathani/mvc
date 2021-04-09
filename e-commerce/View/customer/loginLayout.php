<!DOCTYPE html>
<html>

<?php echo $this->getBlock('Block\Admin\Layout\Head')->toHtml(); ?>

<body id="loginBody">
    <div>
        <?php echo $this->getChild('content')->toHtml(); ?>
    </div>
</body>
</html>