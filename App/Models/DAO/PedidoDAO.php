<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Pedido;

class PedidoDAO extends DAO {
    protected $table = 'pedidos';
    protected $class = Pedido::class;

}
