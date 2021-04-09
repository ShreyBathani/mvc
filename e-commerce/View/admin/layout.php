<!DOCTYPE html>
<html>

<?php echo $this->getBlock('Block\Admin\Layout\Head')->toHtml(); ?>

    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td class="p-0"><?php if($this->getChild('header')){ echo $this->getChild('header')->toHtml(); } ?></td>
                </tr>
                <!-- <tr>
                    <td class="pt-3 pl-3"><?php //echo $this->getchild('message')->toHtml(); ?></td>
                </tr> -->
                <tr class="align-top" height="615px">
                    <td class="p-3"><span> <?php echo $this->getBlock('Block\Admin\Layout\Message')->toHtml(); ?> </span><?php echo $this->getChild('content')->toHtml(); ?></td>
                </tr>

                <tr>
                    <td class="p-0"><?php if($this->getChild('footer')){ echo $this->getChild('footer')->toHtml();} ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>