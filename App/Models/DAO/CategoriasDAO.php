<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Categoria;

class CategoriasDAO extends DAO {
    protected $table = 'categoria';
    protected $class = Categoria::class;
}
