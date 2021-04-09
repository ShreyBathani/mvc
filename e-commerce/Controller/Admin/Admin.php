<?php

namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Admin extends \Controller\Core\Admin{

    public function gridAction(){
        try {
    		$filterModel = \Mage::getModel('Model\Admin\Filter')->unsetFilters();
            $gridBlock = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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

    public function filterAction()
	{
		$filters = $this->getRequest()->getPost('filters');
		$filterModel = \Mage::getModel('Model\Admin\Filter');
		$filterModel->setFilters($filters);
		$gridBlock = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($gridBlock);
	}
    
    public function formAction(){
        try{   
            $adminId = (int) $this->getRequest()->getGet('adminId');

            $admin = \Mage::getModel('Model\Admin');
            $admin->load($adminId);
            
            
            if($adminId){
                if (!$admin->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }

            
            /* $layout = $this->getLayout();
            $layout->setTemplate('View/admin/core/layout/twoColumn.php');
            
            $content = $layout->getContent();
            $content->addChild($editBlock);
            
            $left = $layout->getLeft();
            $left->addChild($tabBlock);
            
            $this->renderLayout(); */
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $editBlock = \Mage::getBlock('Block\Admin\Admin\Edit')->setTableRow($admin)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $adminId = (int) $this->getRequest()->getGet('adminId');

            $admin = \Mage::getModel('Model\Admin');
            $admin->load($adminId);
            if($adminId){
                if (!$admin->getOriginalData()) {
                    throw new \Exception("No record found.");
                }
            }
            else{
                $admin->createdDate = date("Y-m-d H:i:s");
            }
            $adminData = $this->getRequest()->getPost('admin');
            $admin->setData($adminData);
            if(!$admin->save()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Data Stored Successfully !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        
        $gridBlock = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }

    public function deleteAction(){
        try{
            $adminId = (int) $this->getRequest()->getGet('adminId');
            if (!$adminId) {
                throw new \Exception("Invalid Id.");
            }
            
            $admin = \Mage::getModel('Model\Admin');
            $admin->load($adminId);
            if(!$admin->getOriginalData()){
                throw new \Exception("No record found.");
            }
            if(!$admin->delete()){
                throw new \Exception("Error Processing Data.");
            }
            $this->getMessage()->setSuccess('Record Successfully deleted !!');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridBlock = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($gridBlock);
    }
}

?>