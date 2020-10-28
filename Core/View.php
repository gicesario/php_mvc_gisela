<?php

namespace Core;

class View {
    public static $defaultViewsPath = 'App/Views';


    public static function render($path, $params = array()){
        $viewPath = self::$defaultViewsPath.'/'.$path.'.phtml';
        if(file_exists($viewPath)){
            extract($params);
            ob_start();
            require $viewPath;
            $view = ob_get_clean();
            if(isset($layout)){
                if(isset($layoutParams)){
                    $params = array_merge($params, $layoutParams);
                }
                print self::renderWithLayout($layout, $view, $params);
            }else{
                print $view;
            }
            return;
        }
        die('View not found');
    }

    private static function renderWithLayout($layout, $view, $params){
        $layoutPath = self::$defaultViewsPath.'/'.$layout.'.phtml';
        if(file_exists($layoutPath)){
            extract(array_merge($params,['body' => $view]));
            ob_start();
            require $layoutPath;
            return ob_get_clean();
        }
        die('Layout not found');
        return null;
    }

    public static function redirect($uri){
        $isRoute = substr( $uri, 0, 4 ) !== 'http';
        $location = $uri;
        if($isRoute){
            $location = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$uri;
        }
        header("Location: $location", TRUE, 301);
        exit();
    }
}

