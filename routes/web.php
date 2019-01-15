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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('elchavo', 'HomeController');

Route::post('habitante', 'HomeController@save');
Route::get('get_all_habitantes', 'HomeController@getAllHabitantes');
Route::get('get_habitante/{habitante_id}', 'HomeController@getHabitante');
Route::delete('delete_habitante/{cliente_id}', 'HomeController@deleteHabitante');
