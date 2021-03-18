<div id="right">

<?php
foreach ($this->getChildren() as $child) {
    echo $child->toHtml();
}
?>

</div>