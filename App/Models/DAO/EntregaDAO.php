<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Entrega;

class EntregaDAO extends DAO {
    protected $table = 'dados_entrega';
    protected $class = Entrega::class;

}
