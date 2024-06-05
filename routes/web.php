<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;

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

$router->post("/auth/login", ["uses" => "AuthController@authenticate"]);
$router->group(["middleware" => "jwt.auth"], function() use ($router){
    $router->get("/auth/user", ["uses" => "UsuarioController@showUsuario"]);

});

$router->get("/producto/masvendido", ["uses" => "ProductoController@masVendidos"]);
$router->get("/producto/relacionados", ["uses" => "ProductoController@relacionado"]);
$router->get("/producto/{producto}/detalle", ["uses" => "ProductoController@detalle"]);
