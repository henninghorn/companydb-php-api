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

$app->get('/', function () use ($app) {
    return $app->version();
});

// Companies
$app->group(['prefix' => 'companies'], function () use ($app) {
    $app->get('/', 'CompanyController@index');
    $app->get('/{id}', 'CompanyController@show');
    $app->post('/', 'CompanyController@store');
    $app->put('/{id}', 'CompanyController@update');

    $app->post('/{company_id}/people/', 'CompanyController@addNewPerson');
});

// People
$app->group(['prefix' => 'api/people'], function () use ($app) {
    $app->get('/', 'PersonController@index');
});
