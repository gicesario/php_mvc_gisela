<?php

namespace App\Models\Entities;

use Core\Entity;

class ProdutoPedido extends Entity{
    public $id;
    public $id_pedidos;
    public $id_produtos;
    public $quantidade_produtos;		
}
