<?php

namespace sistemaTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouterFormRequest extends FormRequest
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
            'idZona'=>'required',
            'IP'=>'required|max:45',
            'UsuarioRB'=>'required|max:45',
            'PasswordRB'=>'required|max:45',
            'PuertoApi'=>'required|max:45',
            'PuertoW'=>'required|max:45',
            'Interfaz'=>'required|max:40',
            'Rangos'=>'required|max:80'
            'Coordenadas'=>'required|max:45'
        ];
    }
}
