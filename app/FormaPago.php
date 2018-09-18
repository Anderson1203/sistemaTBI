<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
  protected $table='formapago';

  protected $primaryKey='idRegistroPago';

  public $timestamps=false;

  protected $fillable = [
    'idRegistroPago',
    'Nombre',
    'Descripcion'
  ];
  protected $guarded=[

  ];
}
