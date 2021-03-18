<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Product\Edit');

Class Media extends \Block\Admin\Product\Edit
{   
    protected $media = null;

    public function __construct() {
        $this->setTemplate('View/admin/product/edit/tabs/media.php');
    }

    public function setMedia($media = null){
        if ($media) {
            $this->$media = $media;
            return $this;
        }
        if($id = $this->getRequest()->getGet('productId')){
            $media = \Mage::getModel('Model\Product\Media');
            $query = "SELECT * FROM {$media->getTableName()} WHERE `productId` = {$id}";
            $media = $media->fetchAll($query); //collection-object or false
            if($media){
                $this->media = $media;
                return $this;
            }
        }
        $this->media = $media;
        return $this;
    }

    public function getMedia(){
        if (!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
}

?>