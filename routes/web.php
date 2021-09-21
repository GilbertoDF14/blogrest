<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/login', 'AuthController@login');

$router->group(['middleware'=>['auth']], function() use($router){ 
    $router->get('/usuario', 'UserController@index');
    $router->get('/usuario/{user}', 'UserController@get');
    $router->post('/usuario', 'UserController@create');
    $router->put('/usuario/{user}', 'UserController@update');
    $router->delete('/usuario/{user}', 'UserController@destroy');

    $router->get('/tema', 'TopicController@index');
    $router->get('/tema/{topic}', 'TopicController@get');
    $router->post('/tema', 'TopicController@create');
    $router->put('/tema/{topic}', 'TopicController@update');
    $router->delete('/tema/{topic}', 'TopicController@destroy');

    $router->get('/mensaje', 'PostController@index');
    $router->get('/mensaje/{post}', 'PostController@get');
    $router->post('/mensaje', 'PostController@create');
    $router->put('/mensaje/{post}', 'PostController@update');
    $router->delete('/mensaje/{post}', 'PostController@destroy');

    //$router->get('/topic', 'TopicController@index');
    }
);
