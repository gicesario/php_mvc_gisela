<?php 

use Core\Routing\Route;

Route::get('/','IndexController@index');


Route::group(['prefix' => 'checkout', 'controller' => 'CheckoutController'], function () {
    Route::get('/','index');
    Route::get('/finalizar','finalizar');
    Route::get('/finalizado','finalizado');
});


Route::group(['prefix' => 'carrinho', 'controller' => 'CarrinhoController'], function () {
    Route::get('/','index');
    Route::post('/add','add');
    Route::post('/update','update');
    Route::post('/remove','remove');
});

Route::group(['prefix' => 'conta', 'controller' => 'ContaController'], function () {
    Route::get('/','index');
    Route::get('/registro','registro');
    Route::post('/registro','gravar');
    Route::get('/login','loginForm');
    Route::post('/login','loginAction');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['controller' => 'Admin/LoginController'], function(){
        Route::get('/login', 'loginForm');
        Route::post('/login', 'loginAction');

        Route::get('/logout', 'logout');
        
        Route::get('/register', 'registerForm');
        Route::post('/register', 'registerAction');
    });
    
    Route::group(['controller' => 'Admin/IndexController'], function(){
        Route::get('/', 'dashboard');
    });

    Route::group(['prefix' => 'categorias', 'controller' => 'Admin/CategoriasController'], function(){
        Route::get('/', 'list');
        Route::get('/visualizar/{id}', 'view');
        Route::get('/novo', 'create');
        Route::post('/novo', 'store');
        Route::get('/alterar/{id}', 'alter');
        Route::post('/alterar/{id}', 'update');
    });    
    
    Route::group(['prefix' => 'marcas', 'controller' => 'Admin/MarcasController'], function(){
        Route::get('/', 'list');
        Route::get('/visualizar/{id}', 'view');
        Route::get('/novo', 'create');
        Route::post('/novo', 'store');
        Route::get('/alterar/{id}', 'alter');
        Route::post('/alterar/{id}', 'update');
    });

    Route::group(['prefix' => 'produtos', 'controller' => 'Admin/ProdutosController'], function(){
        Route::get('/', 'list');
        Route::get('/visualizar/{id}', 'view');
        Route::get('/novo', 'create');
        Route::post('/novo', 'store');
        Route::get('/alterar/{id}', 'alter');
        Route::post('/alterar/{id}', 'update');
    });

    Route::group(['prefix' => 'usuarios', 'controller' => 'Admin/UsuariosController'], function(){
        Route::get('/', 'list');
        Route::get('/visualizar/{id}', 'view');
        Route::get('/novo', 'create');
        Route::post('/novo', 'store');
        Route::get('/alterar/{id}', 'alter');
        Route::post('/alterar/{id}', 'update');
    });

    Route::group(['prefix' => 'pedidos', 'controller' => 'Admin/PedidosController'], function(){
        Route::get('/', 'list');
        Route::get('/visualizar/{id}', 'view');
    });
});
