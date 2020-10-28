<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Endereco;

class EnderecoDAO extends DAO {
    protected $table = 'endereco_cliente';
    protected $class = Endereco::class;

}
