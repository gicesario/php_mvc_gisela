<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

use App\Models\Entities\Categoria;
use App\Models\DAO\CategoriasDAO;

class CategoriasController extends Controller {
    protected $authRequired = true;

    public function list() {
        $dao = new CategoriasDAO();
        $categorias = $dao->listAll();
        return View::render('admin/categorias/list', compact('categorias'));
    }

    public function view($id) {
        $dados = [];
        return View::render('admin/categorias/view', compact('dados'));
    }

    public function create() {
        return View::render('admin/categorias/create');
    }

    public function store() {
        $categoria = new Categoria();
        $categoria->nome_categoria = $this->request['nome'];
        $categoria->desc_categoria = $this->request['descricao'];
        $dao = new CategoriasDAO();
        $dao->insert($categoria);
        return View::redirect('/admin/categorias');
    }

    public function alter($id) {
        $dados = [];
        return View::render('admin/categorias/edit', compact('dados'));
    }  
    
    public function update() {
        return View::redirect('/admin/categorias');
    }
} 


