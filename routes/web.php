<?php

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
$router->get('/', function() {
    return env('APP_NAME',"A-Hackajob-Task");
});
$router->post('auth/login', ['uses' => 'AuthController@authenticate']);

$router->group(['middleware' => 'jwt.auth'],function() use ($router) {
    $router->get('/contact/', 'ContactController@index');
    $router->post('/contact/', 'ContactController@store');
    $router->get('/contact/{id:[0-9]+}', 'ContactController@show');
    $router->put('/contact/{id:[0-9]+}', 'ContactController@update');
    $router->patch('/contact/{id:[0-9]+}', 'ContactController@update');
    $router->delete('/contact/{id:[0-9]+}', 'ContactController@destroy');
    $router->get('/contact/search/', 'ContactController@search');
});




