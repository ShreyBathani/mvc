<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Attribute extends Core\Table
{
    const BACKEND_TYPE_VARCHAR = 'varchar';
    const BACKEND_TYPE_INT = 'int';
    const BACKEND_TYPE_DECIMAL = 'decimal';
    const BACKEND_TYPE_TEXT = 'text';
    
    const INPUT_TYPE_TEXT = 'text';
    const INPUT_TYPE_TEXTAREA = 'textarea';
    const INPUT_TYPE_SELECT = 'select';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_RADIO = 'radio';
    
    const ENTITY_TYPE_PRODUCT = 'product';
    const ENTITY_TYPE_CATEGORY = 'category';

    public function __construct() {
        $this->setPrimaryKey('attributeId');
        $this->setTableName('attribute');
    }

    public function getBackendTypeOptions()
    {
        return [
            self::BACKEND_TYPE_VARCHAR => 'Varchar',
            self::BACKEND_TYPE_INT => 'Int',
            self::BACKEND_TYPE_DECIMAL => 'Decimal',
            self::BACKEND_TYPE_TEXT => 'Text',
        ];
    }
    
    public function getInputTypeOptions()
    {
        return [
            self::INPUT_TYPE_TEXT => 'Text Box',
            self::INPUT_TYPE_TEXTAREA => 'Text Area',
            self::INPUT_TYPE_SELECT => 'Select',
            self::INPUT_TYPE_CHECKBOX => 'Checkbox',
            self::INPUT_TYPE_RADIO => 'Radio',
            
        ];
    }

    public function getEntityTypeOptions()
    {
        return [
            self::ENTITY_TYPE_PRODUCT => 'Product',
            self::ENTITY_TYPE_CATEGORY => 'Category',
        ];
    }

    /* public function getOptions()
    {   
        if (!$this->attributeId) {
            return false;
        }
        $optionModel = \Mage::getModel('Model\Attribute\Option');
        $query = "SELECT * FROM {$optionModel->getTableName()} 
        WHERE `{$this->getPrimaryKey()}` = {$this->attributeId}
        ORDER BY `sortOrder`;";
        return $optionModel->fetchAll($query);
    } */

    public function getOptions()
    {
        if (!$this->attributeId) {
            return false;
        }
        $optionModel = \Mage::getModel($this->backendModel);
        return $optionModel->setAttribute($this)->getOptions();
    }
}

?>