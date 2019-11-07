<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'JeuxController@index');

Route::get('/jeux/{id}', 'JeuxController@displayJeu')->where('id', '[0-9]+'); //la fin correspond au RegExp

Route::prefix('api')->group(function () {
    Route::prefix('jeux')->group(function () {
        Route::post('add', 'JeuxController@add');
        Route::get('all', 'JeuxController@all');
        Route::get('del', 'JeuxController@del');
    });
});

Route::get('/404', function(){
    return view('error404');
});

Route::fallback(function () {
    return view('error404');
});