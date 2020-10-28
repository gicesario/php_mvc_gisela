<?php

namespace Core;

use Core\Database;
use PDO;

abstract class DAO{
    protected $conn;
    protected $table;
    protected $class;
 
    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
        $this->columns = array_keys(get_class_vars($this->class));
    }
 
    public function insert($entity) {
        $this->conn->beginTransaction();
 
        try {
            $properties = get_object_vars($entity);
            $columnsMerged = implode(',', $this->columns);
            $valuesPlaceholders = array_map(function($i){ return ":$i"; }, $this->columns);
            $valuesPlaceholdersMerged = implode(',',$valuesPlaceholders);

            $stmt = $this->conn->prepare(
                "INSERT INTO $this->table ($columnsMerged) VALUES ($valuesPlaceholdersMerged)"
            );

            foreach($properties as $key => $value){
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();
            $id = $this->conn->lastInsertId();
            $this->conn->commit();

            return $id;
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }
 
    public function listAll() {
        $statement = $this->conn->query("SELECT * FROM $this->table");
        return $this->processResults($statement);
    }

    public function find($id) {
        $statement = $this->conn->query("SELECT * FROM $this->table WHERE id = $id");
        return $this->processSingle($statement);
    }
 
    protected function processResults($statement) {
        if($statement) {
            return $statement->fetchAll(PDO::FETCH_CLASS, $this->class);
        }
        return null;
    }

    protected function processSingle($statement){
        $results = $this->processResults($statement);
        if(count($results) > 0){
            return $results[0];
        }
        return null;
    }
}