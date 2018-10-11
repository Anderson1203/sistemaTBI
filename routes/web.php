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
    return view('auth/login');
});

Route::resource('/sistema/plan','PlanController');
Route::resource('/sistema/router','RouterController');
Route::resource('/sistema/factura','FacturaController');
Route::resource('/sistema/pagof','PagosfController');
Route::resource('/sistema/zona','ZonaController');
Route::resource('/sistema/clientes','ClientesController');
Route::resource('/sistema/formapago','FormaPagoController');
Route::resource('/seguridad/usuario','UsuarioController');
Route::resource('/sistema/promesa','PromesaController');

Route::get('/sistema/{id}/clientes','FacturaController@createCliente');

Auth::routes();
Route::get('/home','HomeController@index')->name('home');
Route::get('/{slug?}','HomeController@index')->name('home');
