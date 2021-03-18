<?php

namespace Model\Core;

class Adapter
{
    private $config = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'practice_ecommerce'
    ];
    private $connect = null;

    public function connection(){
        $connect = new \mysqli($this->config['host'], $this->config['username'], $this->config['password'], $this->config['database']);
        $this->setConnect($connect);
        if(!$this->getConnect()) {
            return false;
        }
        return $this;
    }

    public function getConnect(){
        return $this->connect;
    }

    public function setConnect(\mysqli $connect){
        $this->connect = $connect;
        return $this;
    }

    public function isConnected(){
        if(!$this->getConnect()){
            return false;
        }
        return true;
    }

    public function insert($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if($result){
            return $this->getConnect()->insert_id;
        }
        return false;
    }

    public function update($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function delete($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    public function fetchRow($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if($result && $this->getConnect()->affected_rows == 1){
            return $result = $result->fetch_assoc();
        }
        return false;
    }

    public function fetchAll($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if($result){
            return $result = $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }

    public function fetchPairs($query)
    {
        if(!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $result = $result->fetch_all();
        if(!$result){
            return false;
        }
        $columns = array_column($result, '0');
        $values = array_column($result, '1');
        return array_combine($columns, $values);
    }
}

?>