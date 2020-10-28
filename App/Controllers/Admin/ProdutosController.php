<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;

use App\Models\DAO\CategoriasDAO;
use App\Models\DAO\MarcasDAO;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entities\Produto;

class ProdutosController extends Controller {
    protected $authRequired = true;

    public function list() {
        $dao = new ProdutoDAO();
        $produtos = $dao->listAll();
        return View::render('admin/produtos/list', compact('produtos'));
    }

    public function view($id) {
        $dados = [];
        return View::render('admin/produtos/view', compact('dados'));
    }

    public function create() {
        $marcas = (new MarcasDAO())->listAll();
        $categorias = (new CategoriasDAO())->listAll();
        return View::render('admin/produtos/create', compact('marcas','categorias'));
    }

    						

    public function store() {
        $produto = new Produto();
        $produto->nome_chocolate = $this->request['nome'];
        $produto->desc_chocolate = $this->request['descricao'];
        $produto->id_marca_chocolate = $this->request['marca'];
        $produto->id_categoria = $this->request['categoria'];
        $produto->valor_preco = $this->request['valor'];
        $produto->valor_desconto = $this->request['desconto'];
        $produto->quant_diponivel = $this->request['diponivel'];
        $produto->imagem = $this->saveFile($_FILES["imagem"]);

        $dao = new ProdutoDAO();
        $dao->insert($produto);
        return View::redirect('/admin/produtos/');
    }

    public function alter($id) {
        $dados = [];
        return View::render('admin/produtos/edit', compact('dados'));
    }  
    
    public function update() {
        return View::redirect('admin/produtos/');
    }

    private function saveFile($file){
        $fileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
        $fileName = round(microtime(true) * 1000).'.'.$fileType;
        $target_file = "Storage/Images/$fileName";
        move_uploaded_file($file["tmp_name"], $target_file);
        return $target_file;
    }
} 


