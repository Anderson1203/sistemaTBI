<?php

namespace sistemaTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagosfFormRequest extends FormRequest
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
            'IdCliente'=>'required|max:11',
            'idZona'=>'required|max:11',
            'FormaP'=>'required|max:11',
            'FechaEmision'=>'required',
            'FechaPago'=>'required',
            'FechaVenci'=>'required',
            'Estado'=>'required|max:45',
            'Tipo'=>'max:45',
            'Total'=>'required|max:45'
        ];
    }
}
