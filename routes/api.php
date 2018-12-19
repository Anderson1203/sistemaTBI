<?php

use Illuminate\Http\Request;


Route::get('/proyecto/{id}/niveles', 'ClientesController@byclient');
Route::get('/proyectos/{id}/{id2}/cortes', 'ClientesController@creacorte');
Route::get('/sistema/{id}/clientes','ClientesController@cambio');
