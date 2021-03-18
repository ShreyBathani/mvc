<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Admin\Attribute\Edit');

Class Form extends \Block\Admin\Attribute\Edit
{
    public function __construct() {
        $this->setTemplate('View/admin/attribute/edit/tabs/form.php');
    }

    /* public function setAttribute($attribute = null){
        if ($attribute) {
            $this->$attribute = $attribute;
            return $this;
        }
        $attribute = \Mage::getModel('Model\Attribute');
        if($id = $this->getRequest()->getGet('attributeId')){
            $attribute = $attribute->load($id);
        }
        $this->attribute = $attribute;
        return $this;
    } */

    /* public function getAttribute(){
        if (!$this->attribute) {
            $this->setAttribute();
        }
        return $this->getTableRow();
    } */
}

?>