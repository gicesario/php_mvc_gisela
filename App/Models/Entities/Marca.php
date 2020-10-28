<?php

namespace App\Models\Entities;

use Core\Entity;

class Marca extends Entity{
    public $id;
    public $nome_marca;
    public $pais_fornecedor;
    public $cidade_fornecedor;
    public $uf_forcenecor;			
}
