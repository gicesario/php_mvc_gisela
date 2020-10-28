<?php

namespace App\Models\Entities;

use Core\Entity;

class Usuario extends Entity{
    public $id;
    public $email;
    public $senha;
    public $is_admin;
}
