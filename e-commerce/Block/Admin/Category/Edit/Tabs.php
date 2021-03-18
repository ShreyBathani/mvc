<?php

namespace Block\Admin\Category\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

Class Tabs extends \Block\Core\Edit\Tabs{
    
    public function prepareTab()
    {
        $this->addTab('category', ['label' => 'Category Information', 'block' => 'Block\Admin\Category\Edit\Tabs\Form']);
        if ($this->getRequest()->getGet('categoryId')) {
            $this->addTab('media', ['label' => 'Media', 'block' => 'Block\Admin\Category\Edit\Tabs\Media']);
        }
        $this->setDefaultTab('category');
        return $this;
    }
}

?>