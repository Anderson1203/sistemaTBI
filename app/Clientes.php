<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
  protected $table = 'Clientes';

  protected $primaryKey="idClientes";

  public $timetamps=false;

  protected $fillable=[
    'idZona',
    'idRouter',
    'idPlanInt',
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
    'Estatus'
  ];

  protected $guarder=[

  ];
}
