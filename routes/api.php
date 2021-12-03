<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return [
        'status' => '1',
        'code' => '200',
        'data' =>  $request->user()
    ];
});

Route::group(['middleware' => 'auth:api','prefix'=>'city'], function () {
    Route::get('/','cityController@index');
    Route::post('/','cityController@create');
    Route::get('/{id}','cityController@detail');
    Route::put('/{id}','cityController@update');
    Route::delete('/{id}','cityController@delete');
});

Route::group(['middleware' => 'auth:api','prefix'=>'comment'], function () {
    Route::get('/','commentController@index');
    Route::post('/','commentController@create');
    Route::get('/{id}','commentController@detail');
    Route::put('/{id}','commentController@update');
    Route::delete('/{id}','commentController@delete');
});

Route::group(['middleware' => 'auth:api','prefix'=>'place'], function () {
    Route::get('/','placeController@index');
    Route::post('/','placeController@create');
    Route::get('/{id}','placeController@detail');
    Route::put('/{id}','placeController@update');
    Route::delete('/{id}','placeController@delete');
});

Route::group(['middleware' => 'auth:api','prefix'=>'rate'], function () {
    Route::get('/','rateController@index');
    Route::post('/','rateController@create');
    Route::get('/{id}','rateController@detail');
    Route::put('/{id}','rateController@update');
    Route::delete('/{id}','rateController@delete');
});

Route::group(['middleware' => 'auth:api','prefix'=>'review'], function () {
    Route::get('/','reviewController@index');
    Route::post('/','reviewController@create');
    Route::get('/{id}','reviewController@detail');
    Route::put('/{id}','reviewController@update');
    Route::delete('/{id}','reviewController@delete');
});

Route::group(['middleware' => 'auth:api','prefix'=>'user'], function () {
    Route::get('/','userController@index');
    Route::get('/{id}','userController@detail');
    Route::put('/{id}','userController@update');
    Route::delete('/{id}','userController@delete');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});