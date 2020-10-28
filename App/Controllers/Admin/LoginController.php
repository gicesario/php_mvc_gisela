<?php

namespace App\Controllers\Admin
{
    use Core\Controller;
    use Core\View;
    use Core\Auth\User;

    class LoginController extends Controller {       
        public function loginForm() {
            return View::render('admin/auth/login');
        }        
        
        public function loginAction() {
            $email = $this->request['email'];
            $senha = $this->request['password'];
            if(User::login($email, $senha)){
                return View::redirect('/admin');
            }
            return View::redirect('/admin/login');
        }

        public function logout() {
            User::logout();
            return View::redirect('/admin/login');
        }
        
    } 
    
}
    