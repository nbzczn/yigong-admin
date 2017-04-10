<?php

use Illuminate\Http\Request;

//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->resource('user', 'UserController');
    });
});