<?php

use Illuminate\Http\Request;

//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->post('/user', 'UserController@store');
    });
    $api->group(['middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->get('/user_profile', 'UserProfileController@detail');
        $api->put('/user_profile/update', 'UserProfileController@update');
        $api->get('/user/detail', 'UserController@detail');
    });

});