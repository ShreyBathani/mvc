<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Cms extends \Controller\Core\Admin{

    public function gridAction(){
        try {
            $gridBlock = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
            $this->makeResponse($gridBlock);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function formAction(){
        try{  
            $pageId = (int) $this->getRequest()->getGet('pageId');

            $cms = \Mage::getModel('Model\Cms');
            $cms->load($pageId);
            if($pageId){
                if (!$cms->getData()) {
                    throw new \Exception("No record found.");
                }
            }

            $editBlock = \Mage::getBlock('Block\Admin\Cms\Edit')->setTableRow($cms)->toHtml();

        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->makeResponse($editBlock);
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $pageId = (int) $this->getRequest()->getGet('pageId');

            $cms = \Mage::getModel('Model\Cms');
            $cms->load($pageId);
            if($pageId){
                if (!$cms->getData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $cms->createdDate = date("Y-m-d H:i:s");
            }
            $cmsData = $this->getRequest()->getPost('cms');
            $cms->setData($cmsData);
            if(!$cms->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $pageId = (int) $this->getRequest()->getGet('pageId');
            if (!$pageId) {
                throw new \Exception("Invalid Id.");
            }
            
            $cms = \Mage::getModel('Model\Cms');
            $cms->load($pageId);
            if (!$cms->getData()) {
                throw new \Exception("No record found.");
            }
            if(!$cms->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Page Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>