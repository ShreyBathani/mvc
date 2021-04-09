<!DOCTYPE html>
<html>

<?php echo $this->getBlock('Block\Customer\Layout\Head')->toHtml(); ?>

    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td class="p-0"><?php echo $this->getChild('header')->toHtml(); ?></td>
                </tr>

                <tr>
                    <td class="p-o"><?php echo $this->getChild('content')->toHtml(); ?></td>
                </tr>

                <tr>
                    <td><?php echo $this->getChild('footer')->toHtml(); ?></td>
                </tr>
            </tbody>
        </table>
    </body>
    
</html>