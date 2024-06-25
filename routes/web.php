<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get("/",function(){
    echo "Api Ayarte Beta 1.0.0.1";
});

$router->get("/command/migartion", function(){
    Artisan::call("migrate:fresh --seed");
});


$router->group(["middleware" => "jwt.auth"], function() use ($router){

    //RUTAS DE USUARIO
    $router->get("/auth/user", ["uses" => "UsuarioController@showUsuario"]);

    //RUTAS DE USUARIOS - ADMIN
    $router->get("/usuario/lista", ["uses" => "UsuarioController@show"]);
    $router->put("/usuario/{usuario}/update", ["uses" => "UsuarioController@update"]);
    $router->delete("/usuario/{usuario}/destroy", ["uses" => "UsuarioController@destroy"]);
    $router->get("/usuario/{usuario}/detalle", ["uses" => "UsuarioController@detalle"]);

    //RUTAS DE PRODUCTO
    $router->get("/producto/{usuario}/lista", ["uses" => "ProductoController@show"]);
    $router->post("/producto", ["uses" => "ProductoController@store"]);
    $router->put("/producto/{producto}/update", ["uses" => "ProductoController@update"]);
    $router->delete("/producto/{producto}/destroy", ["uses" => "ProductoController@destroy"]);

    //RUTAS DE CATEGORIAS
    $router->get("/categoria/lista", ["uses" => "CategoriaController@show"]);
    $router->post("/categoria", ["uses" => "CategoriaController@store"]);
    $router->put("/categoria/{categoria}/update", ["uses" => "CategoriaController@update"]);
    $router->delete("/categoria/{categoria}/destroy", ["uses" => "CategoriaController@destroy"]);
    $router->get("/categoria/{categoria}/detalle", ["uses" => "CategoriaController@detalle"]);

    //RUTAS DE FAVORITOS
    $router->get("/favorito/{usuario}/lista", ["uses" => "FavoritoController@show"]);
    $router->post("/favorito", ["uses" => "FavoritoController@store"]);
    $router->delete("/favorito/{favorito}/destroy", ["uses" => "FavoritoController@destroy"]);
});

// RUTAS DE USUARIO
$router->post("/auth/login", ["uses" => "AuthController@authenticate"]);
$router->post("/usuario", ["uses" => "UsuarioController@store"]);

//RUTAS DE PRODUCTOS PUBLICO
$router->get("/producto/masvendido", ["uses" => "ProductoController@masVendidos"]);
$router->get("/producto/nuevos", ["uses" => "ProductoController@nuevos"]);
$router->get("/producto/{producto}/detalle", ["uses" => "ProductoController@detalle"]);
$router->get("/producto/{categoria}/relacionado", ["uses" => "ProductoController@productoRelacionado"]);
