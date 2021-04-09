<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Brand extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateAction()
    {
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }
            $brandData = $this->getRequest()->getPost('brand');
            $brand = \Mage::getModel('Model\Brand');
            foreach ($brandData['name'] as $key1 => $value1) {
                $brand->load($key1);
                $brand->name = $value1;
                foreach ($brandData as $key2 => $value2) {
                    if($key2 == 'name' || $key2 == 'remove'){
                        continue;
                    }
                    $brand->$key2 = (in_array($key1, $value2)) ? 1 : 0;
                }
                if(!$brand->save()){
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
            
            $brand = \Mage::getModel('Model\Brand');
            $image = $this->getRequest()->getFile('image');
            if (!$image) {
                throw new \Exception("Please select image.");
            }
            $imageName = $brand->getImagePath().$image["name"];
            
            if (file_exists($imageName)) {
                throw new \Exception("File Already Exists.");
            }
            
            if (!$brand->moveFile($image["tmp_name"], $imageName)) {
                throw new \Exception("Error Storing Image.");
            }

            $brand->feature = 1;
            $brand->imageName = $image["name"];

            if(!$brand->save()){
                throw new \Exception("Error Processing Image.");
            }

            $brandId = $brand->brandId;
            $imageName = $brandId.'.'.pathinfo($image["name"],PATHINFO_EXTENSION);
            rename($brand->getImagePath().$image["name"], $brand->getImagePath().$imageName);
            $brand->imageName = $imageName;
            $brand->save();

            $this->getMessage()->setSuccess('Image Uploaded Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }

    public function deleteAction()
    {
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }
            $image = $this->getRequest()->getPost('brand');
            if (!array_key_exists('remove', $image)) {
                throw new \Exception("Please Select Image.");
            }
            $removeData = $image['remove'];
            $brand = \Mage::getModel('Model\Brand');
            foreach ($removeData as $value) {
                if ($brand->load($value)) {
                    $imageName = $brand->imageName;
                    if(!$brand->delete()){
                        throw new \Exception("Error Processing Data.");
                    }
                    else{
                        unlink($brand->getImagePath().$imageName);
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