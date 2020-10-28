<?php

namespace Core;

class Model {
    protected $table;
    protected static $db;

    public function __construct() {
        self::$db = new Database();
    }

    public static function find($id){
        $result = self::$db->query("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
        if($result){
            return $result;
        }
    }

    public static function listAll(){
        $result = self::$db->query("SELECT * FROM {$this->table}");
        return $result->fetchAll();
    }
    
    public static function insert(Array $data){
        $keys = implode(',',array_keys($data));
        $values =  implode(',',array_values($data));
        self::$db->exec("INSERT INTO {$this->table} ($keys) VALUES ($values)");
    }

    public static function update($id, Array $data){
        $updatedCols = Array();
        foreach($data as $key => $value){
            $updatedCols[] = "$key = $value";
        }
        $updateStatement = implode(',', $updatedCols);

        self::$db->exec("UPDATE {$this->table} SET $updateStatement");
    }

    public static function delete($id){
        self::$db->exec("DELETE FROM {$this->table} WHERE id = $id");
    }
}

