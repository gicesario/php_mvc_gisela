<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

class IndexController extends Controller {
    protected $authRequired = true;

    public function dashboard() {
        $teste = "Teste de parametro pra view";
        return View::render('admin/dashboard', compact('teste'));
    }
} 


