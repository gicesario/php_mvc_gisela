<?php

namespace App\Models\Entities;

use Core\Entity;

class Produto extends Entity{
    public $id;
    public $id_categoria;
    public $id_marca_chocolate;
    public $nome_chocolate;
    public $desc_chocolate;
    public $valor_preco;
    public $valor_desconto;
    public $quant_diponivel;					
    public $imagem;					
}
