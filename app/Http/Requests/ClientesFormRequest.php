<?php

namespace sistemaTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesFormRequest extends FormRequest
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
          'idClientes'=>'max:11',
          'IdZona'=>'required',
          'IdRouter'=>'required',
          'IdPlanInt'=>'required',
          'Nombre'=>'required',
          'ApellidoP'=>'required',
          'ApellidoM'=>'required',
          'Email'=>'required',
          'Direccion'=>'required',
          'Telefono'=>'required',
          'NombreConec'=>'required',
          'Ip'=>'required',
          'MacCp'=>'required',
          'Coord'=>'max:60',
          'Coord1'=>'max:60',
          'Referencia'=>'max:20',
          'Estatus'=>'required'
        ];
    }
}
