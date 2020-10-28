<?php

namespace App\Controllers
{
    use Core\Controller;
    use Core\View;
    use Core\Session;

    use App\Models\DAO\CategoriasDAO;
    use App\Models\DAO\MarcasDAO;
    use App\Models\DAO\ProdutoDAO;
    use App\Models\Entities\Produto;

    class IndexController extends Controller {

        public function index() {
            $produtos = (new ProdutoDAO())->listAll();;
            $marcas = (new MarcasDAO())->listAll();;
            $categorias = (new CategoriasDAO())->listAll();;
            return View::render('site/home', compact('produtos','marcas','categorias'));
        }

    } 
} 

