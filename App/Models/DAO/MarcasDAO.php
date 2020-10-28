<?php

namespace App\Models\DAO;

use Core\DAO;
use App\Models\Entities\Marca;

class MarcasDAO extends DAO {
    protected $table = 'marca_chocolate';
    protected $class = Marca::class;

}
