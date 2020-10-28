<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

use App\Models\DAO\PedidoDAO;
use App\Models\Entities\Pedido;

class PedidosController extends Controller {
    protected $authRequired = true;

    public function list() {
        $dao = new PedidoDAO();
        $pedidos = $dao->listAll();
        return View::render('admin/pedidos/list', compact('pedidos'));
    }

    public function view($id) {
        $dados = [];
        return View::render('admin/pedidos/view', compact('dados'));
    }
} 


