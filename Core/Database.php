<?php

namespace Core;

use PDO;

class Database {
    private static $instance;
    private $conn;

    protected function __construct(){
        $config = require('Config/Database.php');
        $this->conn = new PDO("mysql:host={$config['host']};dbname={$config['database']}", 
            $config['user'], 
            $config['password'],
            [PDO::ATTR_PERSISTENT => true]);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }

    public function query($statement){
        return $this->conn->query($statement);
    }    
    
    public function exec($statement){
        return $this->conn->exec($statement);
    }
}
