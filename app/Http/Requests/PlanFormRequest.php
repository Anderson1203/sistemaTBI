<?php

namespace sistemaTurbo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanFormRequest extends FormRequest
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
            'Precio'=>'required|max:11',
            'Velocidad'=>'required|max:45',
            'subida'=>'required|max:45',
            'descripcion'=>'max:300'
            
        ];
    }
}
