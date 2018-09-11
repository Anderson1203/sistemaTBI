<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $table='router';

    protected $primaryKey='idRouter';

    public $timestamps=false;

    protected $fillable = [
        'Nombre',
    	'idZona',
        'IP',
        'UsuarioRB',
        'PasswordRB',
        'PuertoApi',
        'PuertoW',
    	'Interfaz',
    	'Rangos',
    	'Coordenadas'
    ];
    protected $guarded=[

    ];
}
