<?php

namespace App\Models\Entities;

use Core\Entity;

class Cliente extends Entity{
    public $id;
    public $id_usuarios;
    public $nome;
    public $fone;
    public $cpf;			
}
