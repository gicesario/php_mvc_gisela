<?php
namespace Core
{
    use Core\Auth\User;

    class Controller {
        public $request;
        protected $authRequired = false;

        public function __construct() {
            if($this->authRequired){
                if(!User::isAdmin()){
                    return View::redirect('/admin/login');
                    die("acesso negado");
                }
            }
        }
    }
}
