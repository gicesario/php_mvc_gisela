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

    class CarrinhoController extends Controller {

        public function index() {
            $carrinho = Session::get('cart');
            $produtos = (new ProdutoDAO())->findAllIds(array_keys($carrinho));
            return View::render('site/carrinho', compact('produtos','carrinho'));
        }

        public function add() {
            $currentCart = Session::get('cart') ?? [];
            $currentCart[$this->request['produto_id']] = [
                'qtd' => 1
            ];
            
            Session::put('cart', $currentCart);
            
            return View::redirect('/carrinho');
        }        
        
        public function update() {
            $currentCart = Session::get('cart') ?? [];
            if($this->request['qtd'] > 0){
                $currentCart[$this->request['produto_id']] = [
                    'qtd' => $this->request['qtd']
                ];
            }
            else
            {
                unset($currentCart[$this->request['produto_id']]);
            }
            Session::put('cart', $currentCart);

            return View::redirect('/carrinho');
        }

        public function remove() {
            $currentCart = Session::get('cart') ?? [];
            unset($currentCart[$this->request['produto_id']]);
            Session::put('cart', $currentCart);

            return View::redirect('/carrinho');
        }

    } 
} 

