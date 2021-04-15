<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'InicioController')->name('inicio');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/establecimiento/create', 'EstablecimientoController@create')->name('establecimiento.create')->middleware('revisar');
    Route::post('/establecimientos', 'EstablecimientoController@store')->name('establecimiento.store');
    Route::get('/establecimiento/edit', 'EstablecimientoController@edit')->name('establecimiento.edit');
    Route::put('/establecimiento/{establecimiento}', 'EstablecimientoController@update')->name('establecimiento.update')->where('establecimiento', '[0-9]+');

    // ALMACENAR IMAGENES
    Route::post('/imagenes/store', 'ImagenController@upload')->name('imagen.store');
    Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagen.destroy');
});

// OOPS
Route::get('/oops', 'OopsController')->name('oops');
