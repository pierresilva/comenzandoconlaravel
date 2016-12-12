<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/holamundo', function () {

    $array = [
        "uno" => "Un elemneto del array",
    ];

    dd($array);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/test', 'TestController');

Route::get('/task', 'TaskController@index');
Route::get('/task/create', 'TaskController@create');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');
