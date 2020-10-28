<?php

namespace App\Controllers
{
    use Core\Controller;
    use Core\View;
    use Core\Session;
    use Core\Auth\User;

    use App\Models\DAO\UsuariosDAO;
    use App\Models\DAO\EnderecoDAO;
    use App\Models\DAO\ClienteDAO;

    use App\Models\Entities\Usuario;
    use App\Models\Entities\Endereco;
    use App\Models\Entities\Cliente;

    class ContaController extends Controller {

        public function index() {
            if(User::isClient()){
                return View::render('site/conta', compact('usuario'));
            }
            return View::redirect('/conta/login');
        }

        public function loginForm() {
            return View::render('site/login');
        }           
        
        public function loginAction() {
            $email = $this->request['email'];
            $senha = $this->request['senha'];
            if(User::login($email, $senha)){
                return View::redirect('/conta');
            }
            return View::redirect('/conta/login');
        }         
        
        public function registro() {
            return View::render('site/registro');
        }        
        
        public function gravar() {
            //gravar usuario
            $usuario = new Usuario();
            $usuario->email = $this->request['email'];
            $usuario->senha = password_hash($this->request['senha'], PASSWORD_DEFAULT);
            $usuario->is_admin = 0;
            $id_usuario = (new UsuariosDAO())->insert($usuario);

            //gravar cliente
            $cliente = new Cliente();
            $cliente->id_usuarios = $id_usuario;
            $cliente->nome = $this->request['nome'];
            $cliente->cpf = $this->request['cpf'];
            $cliente->fone = $this->request['fone'];
            $id_cliente = (new ClienteDAO())->insert($cliente);

            //gravar endereço

            $endereco = new Endereco();
            $endereco->id_clientes = $id_cliente;
            $endereco->cep = $this->request['cep'];
            $endereco->endereco = $this->request['endereco'];
            $endereco->num_endereco = $this->request['numero'];
            $endereco->compl_endereco = $this->request['complemento'] ?? '';
            $endereco->bairro = $this->request['bairro'];
            $endereco->cidade = $this->request['cidade'];
            $endereco->uf = $this->request['estado'];
            (new EnderecoDAO())->insert($endereco);

            return View::redirect('/conta');
        }

    } 
} 

