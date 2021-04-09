<!DOCTYPE html>
<html>

<?php echo $this->getBlock('Block\Core\Layout\Head')->toHtml(); ?>

    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="2" class="p-0"><?php echo $this->getChild('header')->toHtml(); ?></td>
                </tr>

                <tr height="630px" class="align-top">
                    <td width="200px" class="p-0 bg-dark"><?php echo $this->getChild('left')->toHtml(); ?></td>

                    <td class="p-3">
                        <?php echo $this->getBlock('Block\Admin\Layout\Message')->toHtml(); ?>
                        <?php echo $this->getChild('content')->toHtml(); ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="p-0"><?php echo $this->getChild('footer')->toHtml(); ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>