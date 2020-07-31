<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'customers'], function($router) {
    $router->get('/', 'CustomerController@getAll');
    $router->post('/', 'CustomerController@create');
    $router->put('/{id:[\d+]}', 'CustomerController@update');
    $router->delete('/{id:[\d+]}', 'CustomerController@delete');
});

$router->group(['prefix' => 'employees'], function($router) {
    $router->get('/', 'EmployeeController@getAll');
    $router->post('/', 'EmployeeController@create');
    $router->put('/{id:[\d+]}', 'EmployeeController@update');
    $router->delete('/{id:[\d+]}', 'EmployeeController@delete');
});

$router->group(['prefix' => 'schedulings'], function($router) {
    $router->get('/', 'SchedulingController@getAll');
    $router->post('/', 'SchedulingController@create');
    $router->put('/{id:[\d+]}', 'SchedulingController@update');
    $router->delete('/{id:[\d+]}', 'SchedulingController@delete');
});
