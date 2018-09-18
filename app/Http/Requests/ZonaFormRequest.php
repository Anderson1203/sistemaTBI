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
          'Nombre'=>'required',
          'Descripcion'=>'Max:250',
          'Tipo'=>'required',
          'Aviso'=>'required',
          'CreaFactura'=>'required',
          'Hora1'=>'required',
          'DiaPago'=>'required',
          'Recordar'=>'required',
          'Hora2'=>'required',
          'RecorPago'=>'required',
          'CortePag'=>'required',
          'Hora3'=>'required',
          'Suspender'=>'required',
          'Impuesto'=>'required',
          'Moneda'=>'required'
        ];
    }
}
