<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zona';

    protected $primaryKey="idZona";

    public $timestamps=false;


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
      'CortePag',
      'Hora3',
      'Suspender',
      'Impuesto',
      'Moneda'
    ];

    protected $guarder=[

    ];
}
