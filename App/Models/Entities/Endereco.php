<?php

namespace App\Models\Entities;

use Core\Entity;

class Endereco extends Entity{
    public $id;
    public $id_clientes;
    public $cep;
    public $endereco;
    public $num_endereco;
    public $compl_endereco;
    public $bairro;
    public $cidade;
    public $uf;                                   	
}
