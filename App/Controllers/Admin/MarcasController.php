<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

use App\Models\Entities\Marca;
use App\Models\DAO\MarcasDAO;

class MarcasController extends Controller {
    protected $authRequired = true;

    public function list() {
        $dao = new MarcasDAO();
        $marcas = $dao->listAll();
        return View::render('admin/marcas/list', compact('marcas'));
    }

    public function view($id) {
        $dados = [];
        return View::render('admin/marcas/view', compact('dados'));
    }

    public function create() {
        $dados = [];
        return View::render('admin/marcas/create', compact('dados'));
    }

    public function store() {
        $marca = new Marca();
        $marca->nome_marca = $this->request['nome'];
        $marca->pais_fornecedor = $this->request['pais'];
        $marca->cidade_fornecedor = $this->request['cidade'];
        $marca->uf_forcenecor = $this->request['uf'];
        $dao = new MarcasDAO();
        $dao->insert($marca);
        return View::redirect('/admin/marcas/');
    }

    public function alter($id) {
        $dados = [];
        return View::render('admin/marcas/edit', compact('dados'));
    }  
    
    public function update() {
        return View::redirect('admin/marcas/');
    }
} 


