<?php
class ExecSQL{
    private $conn;
    protected function exeCMD($stmt)
    {
        if($stmt->execute())
        { return true; }
        else{ return false; }
    }
     public function __construct($str_conn){
        $this->conn =$str_conn;
     }
     public function readAll($tablename){
        $stmt =$this->conn->prepare("SELECT * FROM ".$tablename);
        $stmt ->execute();
        return $stmt;
    }
     public function insert($tablename,$field,$value){
        $stmt = $this->conn->prepare(" INSERT INTO $tablename ($field) VALUES ($value) ");
        return $this->exeCMD($stmt);
    }
    public function delete($tablename,$condition){
        $stmt =$this->conn->prepare("DELETE FROM $tablename $condition");
        return $this->exeCMD($stmt);
    }
    public function update($tablename,$condition){
        $stmt =$this->conn->prepare(" UPDATE " .$tablename .$condition);
        return $this->exeCMD($stmt);
    }
}

?>