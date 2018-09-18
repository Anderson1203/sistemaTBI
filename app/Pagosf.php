<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Pagosf extends Model
{
    protected $table='factura';

    protected $primaryKey='idFactura';

    public $timestamps=false;

    protected $fillable = [
    	'IdCliente',
    	'idZona',
    	'FormaP',
    	'FechaEmision',
    	'FechaPago',
    	'FechaVenci',
    	'Estado',
    	'Tipo',
    	'Total'
    ];
    protected $guarded=[

    ];
}
