<?php
namespace Core;

class Session {

    public static function start(){
        session_start();
    }

    public static function put($key,$value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return $_SESSION[$key] ?? null;
    }

    public static function has($key){
        return isset($_SESSION[$key]);
    }

    public static function clear($key){
        unset($_SESSION[$key]);
    }

    public static function clearAll(){
        session_unset();
    }
}