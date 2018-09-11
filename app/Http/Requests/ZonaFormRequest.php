<?php

namespace sistemaTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZonaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre'=>'required|max:45',
            'Descripcion'=>'max:250',
            'Tipo'=>'required',
            'Aviso'=>'requiered',
            'CreaFactura'=>'requiered',
            'Hora1'=>'requiered',
            'Diapago'=>'requiered',
            'Recordar'=>'requiered',
            'Hora2'=>'requiered',
            'RecorPAgo'=>'requiered',
            'CortePag'=>'requiered',
            'Hora3'=>'required',
            'Suspender'=>'required',
            'Impuesto'=>'requiered',
            'Moneda'=>'requiered'
        ];
    }
}
