<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Usuario;

class UsuariosDAO extends DAO {
    protected $table = 'usuarios';
    protected $class = Usuario::class;

    public function findByEmail($email){
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE email = :email");
        $stmt->execute([":email" => $email]);
        return $this->processSingle($stmt);
    }
}
