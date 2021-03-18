<!DOCTYPE html>
<html>
    <head>
        <title>QuesteCom</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "icon" href = "<?php echo $this->baseUrl('Skin/Admin/logo/favicon.ico'); ?>" type = "image/x-icon">
        <link rel="stylesheet" href="<?php echo $this->baseUrl('Skin/Admin/css/style.css'); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e7222f1108.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/js/jquery-3.6.0.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/js/mage.js'); ?>"></script>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    </head>
    <body>
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="3" class="p-0"><?php echo $this->getChild('header')->toHtml(); ?></td>
                </tr>

                <tr height="630px" class="align-top">
                    <td width="200px" class="p-0"><?php echo $this->getChild('left')->toHtml(); ?></td>

                    <td class="p-3">
                        <?php echo $this->getChild('message')->toHtml(); ?>
                        <?php echo $this->getChild('content')->toHtml(); ?>
                    </td>

                    <td width="200px" class="p-3"><?php echo $this->getChild('right')->toHtml(); ?></td>
                </tr>

                <tr>
                    <td colspan="3" class="p-0"><?php echo $this->getChild('footer')->toHtml(); ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>