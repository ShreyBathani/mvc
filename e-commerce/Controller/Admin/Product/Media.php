<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Media extends \Controller\Core\Admin{

    public function gridAction(){
        try {
            $productId = (int) $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getData()){
                    throw new \Exception("Record Not Found.");
                }
            }

            $formBlock = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->makeResponse($formBlock);
    }

    public function saveMediaAction()
    {   
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }

            $productId = $this->getRequest()->getGet('productId');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getData()){
                    throw new \Exception("Record Not Found.");
                }
            }

            $mediaData = $this->getRequest()->getPost('media');
            $media = \Mage::getModel('Model\Product\Media');

            foreach ($mediaData['label'] as $key1 => $value1) {
                $media->label = $value1;
                foreach ($mediaData as $key2 => $value2) {
                    if($key2 == 'label' || $key2 == 'remove'){
                        continue;
                    }
                    $media->$key2 = (in_array($key1, $value2)) ? 1 : '';
                }
                $media->imageId = $key1;
                if(!$media->save()){
                    throw new \Exception("Error Processing Data.");
                }
                $this->getMessage()->setSuccess('Data Updated Successfully !!');
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }

    public function uploadImageAction()
    {
        try {
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }
            $productId = (int) $this->getRequest()->getGet('productId');
            if (!$productId) {
                throw new \Exception("Invalid Id.");
            }
            
            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if(!$product->getData()){
                throw new \Exception("Product Not Found.");
            }
            
            $media = \Mage::getModel('Model\Product\Media');
            $image = $this->getRequest()->getFile('productFile');
            $imageName = $media->getImagePath().$image["name"];
            
            if (file_exists($imageName)) {
                throw new \Exception("File Already Exists.");
            }
            
            if (!$media->moveFile($image["tmp_name"], $imageName)) {
                throw new \Exception("Error Storing Image.");
            }

            $media->gallery = 1;
            $media->imageName = $image["name"];
            $media->productId = $productId;

            if(!$media->save()){
                throw new \Exception("Error Processing Image.");
            }

            $imageId = $media->imageId;
            $imageName = $productId.'_'.$imageId.'.'.pathinfo($image["name"],PATHINFO_EXTENSION);
            rename($media->getImagePath().$image["name"], $media->getImagePath().$imageName);
            $media->imageName = $imageName;
            $media->save();

            $this->getMessage()->setSuccess('Image Uploaded Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
        
    }

    public function deleteMediaAction()
    {   
        try{
            $productId = (int) $this->getRequest()->getGet('productId');
            if (!$productId) {
                throw new \Exception("Invalid Id.");
            }

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if(!$product->getData()){
                throw new \Exception("Record Not Found.");
            }

            $image = $this->getRequest()->getPost('media');
            if (!array_key_exists('remove', $image)) {
                throw new \Exception("Please Select Image.");
            }
            $removeData = $image['remove'];
            $media = \Mage::getModel('Model\Product\Media');
            foreach ($removeData as $value) {
                if ($media->load($value)) {
                    $imageName = $media->imageName;
                    if(!$media->delete()){
                        throw new \Exception("Error Processing Data.");
                    }
                    else{
                        unlink($media->getImagePath().$imageName);
                        $this->getMessage()->setSuccess('Record Successfully Deleted !!');
                    }  
                }
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}

?>