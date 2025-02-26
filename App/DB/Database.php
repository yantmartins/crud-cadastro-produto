<?php

class Database{
    private $conn;
    private string $local='10.28.1.115';
    private string $db= 'products';
    private string $user = 'devweb';
    private string $password = 'suporte@22';
    private string $table;

    function __construct($table = null){
        $this->table = $table;
        $this->conecta();
    }

    private function conecta(){
        try{
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=".$this->db,$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $err){
            die("Connection Failed ".$err->getMessage());
        }
    }

    public function execute($query, $binds = []){
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        }catch(PDOException $err){
            die("Connection Failed ".$err->getMessage());
        }
    }

    public function insert($values){
        $fields = array_keys($values);

        $binds = array_pad([],count($fields), '?');

        $query = 'INSERT INTO '.$this->table. ' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        $res = $this->execute($query, array_values($values));

        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    public function select($where = null,$order = null,$limit = null,$fields = '*'){

        $where = strlen($where) ? 'WHERE ' .$where : '';
        $order = strlen($order) ? 'ORDER BY ' .$order : '';
        $limit = strlen($limit) ? 'LIMIT' .$limit : '';

        $query = 'SELECT '.$fields. ' FROM ' .$this->table .' '.$where;

        return $this->execute($query);
    }

    public function update($where,$values){
        $fields = array_keys($values);
        $param = array_values($values);
        $query = 'UPDATE ' .$this->table.' SET ' .implode('=?,',$fields). '=? WHERE ' .$where;

        $res = $this->execute($query,$param);
        if($res){
            return true;
        }
    }

    public function delete($where){
        $query = 'DELETE FROM ' .$this->table. ' WHERE ' .$where;
        $result = $this->execute($query);

        if($result->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}