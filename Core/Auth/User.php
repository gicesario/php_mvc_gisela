<?php

namespace Core\Auth;

use Core\Session;
use App\Models\DAO\UsuariosDAO;

class User {
    public static function login($email, $password){
        $usuario = self::authenticate($email, $password);
        if($usuario){
            Session::put('loggedUserId', $usuario->id);
            return true;
        }
        return false;
    }

    private static function authenticate($email, $password){
        $dao = new UsuariosDAO();
        $usuario = $dao->findByEmail($email);
        if($usuario){
            $isValid = password_verify($password, $usuario->senha);
            if($isValid){
                return $usuario;
            }
        }
        return null;
    }

    public static function isUserLoggedIn(){
        return Session::has('loggedUserId');        
    }

    public static function getCurrent(){
        if(self::isUserLoggedIn()){
            $id = Session::get('loggedUserId');
            return (new UsuariosDAO())->find($id);
        }
        return null;
    }
    
    public static function isAdmin(){
        $usuario = self::getCurrent();
        if($usuario){
            return $usuario->is_admin;
        }
        return false;
    }

    public static function isClient(){
        $usuario = self::getCurrent();
        if($usuario){
            return !$usuario->is_admin;
        }
        return false;
    }

    public static function logout(){
        Session::clear('loggedUserId');
    }

}