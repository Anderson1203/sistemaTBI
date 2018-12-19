<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Registrop extends Model
{
  protected $table='pagos';

  protected $primaryKey='IdPagos';

  public $timestamps=false;

  protected $fillable = [
    'IdPagos',
    'IdUsu',
    'Imagen'
  ];
  protected $guarded=[

  ];
}
