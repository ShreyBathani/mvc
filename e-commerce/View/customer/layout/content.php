<div id="content">

<?php
    foreach ($this->getChildren() as $child) {
        echo $child->toHtml();
    }

?>

</div>