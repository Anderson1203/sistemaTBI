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
          'idZona'=>'requiered',
          'idRouter'=>'required',
          'idPlanInt'=>'required',
          'Nombre'=>'required|max:45',
          'ApellidoP'=>'required|max:45',
          'ApellidoM'=>'required|max:45',
          'Email'=>'requiered',
          'Direccion'=>'requiered',
          'Telefono'=>'requiered',
          'NombreConec'=>'requiered',
          'Ip'=>'requiered',
          'MacCp'=>'requiered',
          'Coordenada'=>'requiered',
          'Estatus'=>'requiered'
        ];
    }
}
