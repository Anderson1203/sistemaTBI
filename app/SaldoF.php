<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class SaldoF extends Model
{
  protected $table = 'clientes';

  protected $primaryKey="idClientes";

  public $timestamps=false;

  protected $fillable=[
      'SaldoF'
  ];

  protected $guarder=[

  ];
}
