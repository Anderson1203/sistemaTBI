<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table='factura';

    protected $primaryKey='idFactura';

    public $timestamps=false;

    protected $fillable = [
    	'idCliente',
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
