<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
  protected $table = 'clientes';

  protected $primaryKey="idClientes";

  public $timestamps=false;

  protected $fillable=[
    'idClientes',
    'IdZona',
    'IdRouter',
    'IdPlanInt',
    'Nombre',
    'ApellidoP',
    'ApellidoM',
    'Email',
    'Direccion',
    'Telefono',
    'NombreConec',
    'Ip',
    'MacCp',
    'Coordenada',
    'Estatus',
    'Referencia'
  ];

  protected $guarder=[

  ];
}
