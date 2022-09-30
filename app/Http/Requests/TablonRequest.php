<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TablonRequest extends FormRequest
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
            'nombre'=>'required|string|min:6',
            'descripcion'=>'required|string|min:10',
            'tipo'=>'required',
            'precio'=>'required|numeric|min:10|regex:/^[\d]{1,3}(\.[\d]{1,2})?$/',
        ];
    }

    public function messages(){
    
        return [
        'nombre.required' => 'Nombre de servicio obligatorio',
        'nombre.min' => 'Nombre de servicio muy corto',
        'descripcion.required' => 'Descripcion obligatoria',
        'descripcion.min' => 'Descripción muy corta',
        'tipo.required' => 'Seleccione tipo',
        'precio.regex' => 'Precio inválido',
        'precio.numeric' => 'Solo decimales con punto',
        ];
    }
}
