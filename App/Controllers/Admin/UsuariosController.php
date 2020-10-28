<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

use App\Models\Entities\Usuario;
use App\Models\DAO\UsuariosDAO;

class UsuariosController extends Controller {
    protected $authRequired = true;

    public function list() {
        $dao = new UsuariosDAO();
        $usuarios = $dao->listAll();
        return View::render('admin/usuarios/list', compact('usuarios'));
    }

    public function view($id) {
        $dados = [];
        return View::render('admin/usuarios/view', compact('dados'));
    }

    public function create() {
        return View::render('admin/usuarios/create');
    }

    public function store() {
        $usuario = new Usuario();
        $usuario->email = $this->request['email'];
        $usuario->senha = password_hash($this->request['senha'], PASSWORD_DEFAULT);
        $usuario->is_admin = true;
        $dao = new UsuariosDAO();
        $dao->insert($usuario);
        return View::redirect('/admin/usuarios/');
    }

    public function alter($id) {
        $dados = [];
        return View::render('admin/usuarios/edit', compact('dados'));
    }  
    
    public function update() {
        return View::redirect('/admin/usuarios/');
    }
} 


