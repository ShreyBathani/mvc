<?php

namespace Model\Brand;

\Mage::loadFileByClassName('Model\Attribute\option');

class Option extends \Model\Attribute\option
{
    public function getOptions()
    {
        if (!$this->getAttribute()->attributeId) {
            return false;
        }
        $optionModel = \Mage::getModel('Model\Brand');
        $query = "SELECT brandId as optionId, name, '{$this->getAttribute()->attributeId}' as attributeId, sortOrder
        FROM `{$optionModel->getTableName()}`
        ORDER BY `sortOrder` ASC;";
        return $optionModel->fetchAll($query);
    }
}


?>