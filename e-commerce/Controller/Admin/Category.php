<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Category extends \Controller\Core\Admin
{
    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $this->makeResponse($gridBlock);
            
            /* $layout = $this->getLayout();
            $content = $layout->getContent();
            $content->addChild($gridBlock);
            $this->renderLayout(); */
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function formAction(){
        try {
            $categoryId = (int) $this->getRequest()->getGet('categoryId');

            $category = \Mage::getModel('Model\Category');
            $category->load($categoryId);
            if ($categoryId) {
                if(!$category->getData()){
                    throw new \Exception("No Record Found.");
                }
            }

            $editBlock = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();

            /* $layout = $this->getLayout();
            $layout->setTemplate('View/admin/core/layout/twoColumn.php');
            
            $content = $layout->getContent();
            $content->addChild($editBlock);

            $left = $layout->getLeft();
            $left->addChild($blockTab);
            
            $this->renderLayout(); */
        } 
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->makeResponse($editBlock);
    }
    
    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }

            $categoryId = (int) $this->getRequest()->getGet('categoryId');

            $category = \Mage::getModel('Model\Category');
            $category->load($categoryId);
            if ($categoryId) {
                if(!$category->getData()){
                    throw new \Exception("No Record Found.");
                }
            }
            $categoryData = $this->getRequest()->getPost('category');
            $category->setData($categoryData);
            if($category->save()){
                $pathId = $category->pathId;
                if($category->updatePathId()){
                    if($category->updateChildrenPathIds($pathId)) {
                    }
                    $this->getMessage()->setSuccess('Data Stored Successfully !!');
                }
            }
            else{
                throw new \Exception("Error Processing Data.");
            }
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($gridBlock);
        
        //$this->redirect('index', 'index', null, true);
    }
    
    public function deleteAction(){
        try{
            $categoryId = (int) $this->getRequest()->getGet('categoryId');
            if (!$categoryId) {
                throw new \Exception("Invalid Id.");
            }
            
            $category = \Mage::getModel('Model\Category');
            $category->load($categoryId);
            if(!$category->getData()){
                throw new \Exception("No record Found.");
            }

            $pathId = $category->pathId;
            $parentId = $category->parentId;
            $category->updateChildrenPathIds($pathId, $categoryId , $parentId);
            $category->load($categoryId);
            if (!$category->delete()) {
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($gridBlock);
        
        //$this->redirect('index', null, null, true);
    }
}

?>