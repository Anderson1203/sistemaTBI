<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'Zona';

    protected $primaryKey="idZona";

    public $timetamps=false;

    protected $fillable=[
      'Nombre',
      'Descripcion',
      'Tipo',
      'Aviso',
      'CreaFactura',
      'Hora1',
      'DiaPago',
      'Recordar',
      'Hora2',
      'RecorPago',
      'CortePago',
      'Hora3',
      'Suspender',
      'Impuesto',
      'Moneda'
    ];

    protected $guarder=[

    ];
}
