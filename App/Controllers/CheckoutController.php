<?php

namespace App\Controllers
{
    use Core\Controller;
    use Core\View;
    use Core\Auth\User;
    use Core\Session;

    use App\Models\DAO\ClienteDAO;
    use App\Models\DAO\PedidoDAO;
    use App\Models\DAO\ProdutoDAO;
    use App\Models\DAO\ProdutoPedidoDAO;
    use App\Models\Entities\ProdutoPedido;
    use App\Models\Entities\Produto;
    use App\Models\Entities\Pedido;

    class CheckoutController extends Controller {

        public function index() {
            $carrinho = Session::get('cart');
            $produtos = (new ProdutoDAO())->findAllIds(array_keys($carrinho));
            $cliente = User::getCurrent();
            return View::render('site/checkout', compact('produtos','carrinho','cliente'));
        }

        public function finalizar() {

            $carrinho = Session::get('cart');
            $produtos = (new ProdutoDAO())->findAllIds(array_keys($carrinho));
            $user = User::getCurrent();
            $cliente = (new ClienteDAO())->findClienteByUser($user->id);



            $pedido = new Pedido();
            $pedido->id_clientes = $cliente->id;
            $pedido->valor_frete = 0;
            $pedido->data_recebimento = date("Y-m-d h:i:s");
            $pedido->data_entrega = null;	
            $pedido_id = (new PedidoDAO())->insert($pedido);

            foreach($produtos as $produto){
                $qtd = $carrinho[$produto->id]['qtd'];
                $prod_pedido = new ProdutoPedido();
                $prod_pedido->id_pedidos = $pedido_id;
                $prod_pedido->id_produtos = $produto->id;
                $prod_pedido->quantidade_produtos = $qtd;
                (new ProdutoPedidoDAO())->insert($prod_pedido);
            }

            Session::put('cart', []);

            return View::redirect('/checkout/finalizado');
        }

        public function finalizado() {
            return View::render('site/finalizado');
        }

    } 
} 

