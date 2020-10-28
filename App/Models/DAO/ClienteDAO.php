<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Cliente;

class ClienteDAO extends DAO {
    protected $table = 'clientes';
    protected $class = Cliente::class;

    public function findClienteByUser($userId){
        $statement = $this->conn->query("SELECT * FROM $this->table WHERE 1");
        return $this->processSingle($statement);
    }
}
