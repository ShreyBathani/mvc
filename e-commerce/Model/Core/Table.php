<?php

namespace Model\Core;

class Table{
    protected $tableName = null;
    protected $primaryKey = null;
    protected $adapter = null;
    protected $data = [];
    
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
        if(!array_key_exists($key, $this->data))
        {
            return null;
        }
        return $this->data[$key];
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

    public function save()
    {
        date_default_timezone_set("Asia/Calcutta");
        if(!array_key_exists($this->getPrimaryKey(), $this->getData())){
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
        $id = $this->getData()[$this->getPrimaryKey()];
        $query = "UPDATE `{$this->getTableName()}` SET {$strData} WHERE `{$this->getPrimaryKey()}` = '{$id}'";
        return $this->getAdapter()->update($query);
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
        return $this->setData($row);
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
            $value = $row->setData($value);
        }

        $collectionClassName = get_class($this).'\Collection';
        $collection = \Mage::getModel($collectionClassName);
        $collection->setData($rows);
        unset($rows);
        return $collection;
    }

    public function delete()
    {
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            return false;            
        }
        $id = $this->getData()[$this->getPrimaryKey()];
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$id}'";
        $this->unsetData();
        return $this->getAdapter()->delete($query);
    }

    public function fetchPairs($query)
    {
        $rows = $this->getAdapter()->fetchPairs($query);
        if(!$rows){
            return false;
        }
        return $this->setData($rows);
    }
}
?>