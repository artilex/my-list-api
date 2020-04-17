<?php

use Illuminate\Support\Facades\Route;

//  Auth
Route::group([
    'prefix' => 'auth',
    'namespace' => '\User\Http\Controllers'
], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout')->middleware('auth:api');
});


Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::group([
        'namespace' => '\User\Http\Controllers'
    ], function () {
        Route::get('/user', 'UserController@detail');
    });
});
