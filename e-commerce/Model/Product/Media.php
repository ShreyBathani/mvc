<?php

namespace Model\Product;

\Mage::loadFileByClassName('Model\Core\Table');

class Media extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName('product_media');
        $this->setPrimaryKey('imageId');
    }

    public function moveFile($tmpName, $imageName)
    {
        if (!move_uploaded_file($tmpName,$imageName)) {
            return false;
        }
        return $this;
    }

    public function getImagePath()
    {
        return \Mage::getBaseDir('Skin\Admin\image\product\\');
    }
}

?>