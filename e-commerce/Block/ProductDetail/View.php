<?php

namespace Block\ProductDetail;

\Mage::loadFileByClassName("Block\Core\Template");

class View extends \Block\Core\Template
{
    protected $product = null;
    protected $media = null;
    
    public function __construct()
    {
        $this->setTemplate('View/productDetail/view.php');
    }

    public function setProduct(\Model\Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
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
