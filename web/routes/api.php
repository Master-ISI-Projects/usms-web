<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'API\V1',
    'middleware' => 'jwt.auth',
    'prefix' => 'v1'
], function() {
    Route::get('events', 'EventController@index');
    Route::get('news', 'NewsController@index');
});

Route::group([
    'namespace' => 'API\V1',
    'prefix' => 'v1'
], function() {
    Route::get('login', 'AuthController@login');
});


