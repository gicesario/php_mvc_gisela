<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\ProdutoPedido;

class ProdutoPedidoDAO extends DAO {
    protected $table = 'produtos_pedidos';
    protected $class = ProdutoPedido::class;
}
