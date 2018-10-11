<?php

use Illuminate\Http\Request;


Route::get('/proyecto/{id}/niveles', 'FacturaController@byclient');
Route::get('/sistema/{id}/clientes','ClientesController@cambio');
