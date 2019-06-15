<?php
use App\Project;
use FastRoute\Route;
use App\Programmer;

/**
 * Routes for resource programmers
 */

 $router->get('/', function () use ($router) {
     return 'hola';
 });

 $router->get('/key', function() {
    return str_random(32);
});


$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    //$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('programmers', 'ProgrammersController@all');
    $router->get('programmers/{id}', 'ProgrammersController@get');
    $router->post('programmers', 'ProgrammersController@add');
    $router->put('programmers/{id}', 'ProgrammersController@put');
    $router->delete('programmers/{id}', 'ProgrammersController@remove');

    $router->get('projects', 'ProjectsController@all');
    $router->get('projects/{id}', 'ProjectsController@get');
});
