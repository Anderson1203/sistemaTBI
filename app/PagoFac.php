<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class PagoFac extends Model
{
  protected $table='factura';

  protected $primaryKey='idFactura';

  public $timestamps=false;

  protected $fillable = [

    'Total',
    'IdClientes',

  ];
  protected $guarded=[

  ];
}
