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
        if($attributeId = $this->getTableRow()->attributeId){
            $attributeOption = \Mage::getModel('Model\Attribute\Option');
            $query = "SELECT * FROM {$attributeOption->getTableName()} WHERE `attributeId` = {$attributeId};";
            $options = $attributeOption->fetchAll($query);
            if($options){
                $this->options = $options;
                return $this;
            }
        }
        $this->options = $options;
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