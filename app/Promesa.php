<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Promesa extends Model
{
    protected $table='factura';

    protected $primaryKey='idFactura';

    public $timestamps=false;

    protected $fillable = [

    	'FechaVenci',

    ];
    protected $guarded=[

    ];
}
