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
            'idZona'=>'max:11',
            'Nombre'=>'required|max:45',
            'Descripcion'=>'max:250',
            'Tipo'=>'required|max:45',
            'Aviso'=>'required',
            'CreaFactura'=>'required',
            'Hora1'=>'required',
            'DiaPago'=>'required|max:45',
            'Recordar'=>'required|max:45',
            'Hora2'=>'required|max:45',
            'RecorPago'=>'required|max:45',
            'CortePag'=>'required|max:45',
            'Hora3'=>'required|max:45',
            'Suspender'=>'required|max:45',
            'Impuesto'=>'max:11',
            'Moneda'=>'required|max:45'
        ];
    }
}
