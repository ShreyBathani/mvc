<?php

namespace Model\Core;

class Table{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $originalData = [];
    protected $data = [];
    protected $adapter = null;
    
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data))
        {
            return $this->data[$key];
        }
        if(array_key_exists($key, $this->originalData))
        {
            return $this->originalData[$key];
        }
        return null;
    }

    public function __unset($key)
    {
        if(array_key_exists($key, $this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function unsetData()
    {
        $this->data = [];
        return $this;
    }

    public function setOriginalData($originalData)
    {
        $this->originalData = $originalData;
        return $this;
    }

    public function getOriginalData()
    {
        return $this->originalData;
    }

    public function unsetOriginalData()
    {
        $this->originalData = [];
        return $this;
    }

    public function setAdapter($adapter = null)
    {
        if (!$adapter) {
            $adapter = \Mage::getModel('Model\Core\Adapter');
        }
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if(!$this->adapter){
            $this->setAdapter();
        }
        return $this->adapter;
    }

    public function save()
    {
        date_default_timezone_set("Asia/Calcutta");

        if (!$this->getData()) {
            return $this;
        }

        if (array_key_exists($this->getPrimaryKey(), $this->getData())) {
            unset($this->data[$this->getPrimaryKey()]);
        }

        if(!array_key_exists($this->getPrimaryKey(), $this->getOriginalData())){
            $query = "INSERT INTO `{$this->getTableName()}` (`{$this->getPrimaryKey()}`, `".implode("`, `",array_keys($this->getData()))."`) VALUES (null, '".implode("', '",$this->getData())."')";
            $id =  $this->getAdapter()->insert($query);
            $this->load($id);
            return true;
        }

        $strData = null;
        foreach ($this->getData() as $key => $value) 
        {
            if($key != $this->getPrimaryKey()){
                $strData .= "`{$key}` = '{$value}', ";
            }
        }

        $strData = substr_replace($strData, "", -2);
        $id = $this->getOriginalData()[$this->getPrimaryKey()];
        $query = "UPDATE `{$this->getTableName()}` SET {$strData} WHERE `{$this->getPrimaryKey()}` = '{$id}'";
        $result = $this->getAdapter()->update($query);
        
        if ($result) {
            $this->load($id);
        }
        return $result;
    }
    
    public function load($value, $columnName = null)
    {
        if (!$columnName) {
            $columnName = $this->getPrimaryKey();
        }
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$columnName}` = '{$value}'";
        $this->fetchRow($query);
        return $this;
    }

    public function fetchRow($query)
    {
        $row = $this->getAdapter()->fetchRow($query);
        if(!$row){
            return false;
        }
        $this->unsetData();
        return $this->setOriginalData($row);
    }

    public function fetchAll($query = null)
    {
        if(!$query) {
            $query = "SELECT * FROM `{$this->getTableName()}`";   
        }
        $rows = $this->getAdapter()->fetchAll($query);
        if(!$rows){
            $this->unsetData();
            return false;
        }
        foreach ($rows as $key => &$value) {
            $row =  new $this;
            $value = $row->setOriginalData($value);
        }

        $collectionClassName = get_class($this).'\Collection';
        $collection = \Mage::getModel($collectionClassName);
        $collection->setData($rows);
        unset($rows);
        return $collection;
    }

    public function delete()
    {
        if (!array_key_exists($this->getPrimaryKey(), $this->getOriginalData())) {
            return false;            
        }
        $id = $this->getOriginalData()[$this->getPrimaryKey()];
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$id}'";
        $this->unsetOriginalData();
        return $this->getAdapter()->delete($query);
    }

    public function fetchPairs($query)
    {
        $rows = $this->getAdapter()->fetchPairs($query);
        if(!$rows){
            return false;
        }
        return $this->setOriginalData($rows);
    }
}
?>