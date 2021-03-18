<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Cms extends Core\Table{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    
    public function __construct(){
        $this->setTableName('cms_page');
        $this->setPrimaryKey('pageId');
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_DISABLED => 'Disabled',
            self::STATUS_ENABLED => 'Enabled'
        ];
    }
}

?>