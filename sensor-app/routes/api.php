<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.12.2022
 * Time: 16:18
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router){

    $router->get('sensors', [
        'as' => 'sensors', 'uses' => 'Sensors\SensorsController@getSensors'
    ]);
    $router->get('sensor/{id}', [
        'as' => 'sensor', 'uses' => 'Sensors\SensorsController@getSensor'
    ]);
    $router->post('sensors/create', [
        'as' => 'sensors_create', 'uses' => 'Sensors\SensorsController@createSensor'
    ]);
    $router->put('sensor/{id}', [
        'as' => 'sensors_put', 'uses' => 'Sensors\SensorsController@updateSensor'
    ]);
    $router->delete('sensor/{id}', [
        'as' => 'sensor_delete', 'uses' => 'Sensors\SensorsController@deleteSensor'
    ]);
    $router->get('sensor/{id}/params', [
        'as' => 'sensor_params', 'uses' => 'Sensors\SensorsController@getSensorParams'
    ]);
    $router->post('sensor/{id}/create', [
        'as' => 'sensors_params_create', 'uses' => 'Sensors\SensorsController@createSensorParams'
    ]);
});
