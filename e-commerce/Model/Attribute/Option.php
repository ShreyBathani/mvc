<?php

namespace Model\Attribute;

\Mage::loadFileByClassName('Model\Core\Table');

class Option extends \Model\Core\Table{

    protected $attribute = null;

    public function __construct(){
        $this->setTableName('attribute_option');
        $this->setPrimaryKey('optionId');
    }

    public function setAttribute(\Model\Attribute $attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;    
    }

    public function getOptions()
    {   
        if (!$this->getAttribute()->attributeId) {
            return false;
        }
        
        $optionModel = \Mage::getModel('Model\Attribute\Option');
        $query = "SELECT * FROM {$optionModel->getTableName()} 
        WHERE `attributeId` = {$this->getAttribute()->attributeId}
        ORDER BY `sortOrder`;";
        return $optionModel->fetchAll($query);
    }
}

?>