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
        'IP',
        'UsuarioRB',
        'PasswordRB',
        'PuertoApi',
        'idZona',
        'PuertoW',
        'Interfaz',
        'Rangos',
        'Coordenadas'

    ];
    protected $guarded=[

    ];
}
       