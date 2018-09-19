<?php

namespace sistemaTurbo;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table='planes';

    protected $primaryKey='idPlanes';

    public $timestamps=false;

    protected $fillable = [
        
    	'Nombre',
    	'Precio',
    	'Velocidad',
    	'Subida',
    	'Descripcion'
    ];
    protected $guarded=[

    ];
}
