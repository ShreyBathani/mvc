<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Brand extends Core\Table
{

    public function __construct(){
        $this->setTableName('brand');
        $this->setPrimaryKey('brandId');
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
        return \Mage::getBaseDir('Skin\Admin\image\brand\\');
    }
}

?>