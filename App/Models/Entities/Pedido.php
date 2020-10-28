<?php

namespace App\Models\Entities;

use Core\Entity;

class Pedido extends Entity{
    public $id;
    public $id_clientes;
    public $valor_frete;
    public $data_recebimento;
    public $data_entrega;				
}
