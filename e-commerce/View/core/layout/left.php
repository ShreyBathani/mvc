<div id="left">

<?php

foreach ($this->getChildren() as $child) {
    echo $child->toHtml();
}

?>

</div>