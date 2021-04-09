<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

Class Option extends \Block\Core\Edit
{
    protected $options = null;
    
    public function __construct() {
        $this->setTemplate('View/admin/attribute/edit/tabs/option.php');
    }

    public function setOptions($options = null){
        if ($options) {
            $this->$options = $options;
            return $this;
        }
        $attributeId = $this->getTableRow()->attributeId;
        $attribute = \Mage::getModel('Model\Attribute')->load($attributeId);
        $this->options = $attribute->getOptions();
        return $this;
    }

    public function getOptions(){
        if (!$this->options) {
            $this->setOptions();
        }
        return $this->options;
    }
}

?>