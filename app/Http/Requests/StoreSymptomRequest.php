<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSymptomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_usuario' => 'required|integer',
            'dificultad_respirar' => 'required|integer|between:0,10',
            'tos' => 'required|integer|between:0,10',
            'nivel_fatiga' => 'required|integer|between:0,10',
            'actividad_inicio_sintomas' => 'required|string',
            'medicina_rescate_usada' => 'required|string',
            'nivel_dolor_cabeza' => 'required|integer|between:0,10',
            'temperatura_mas_alta' => 'required|integer|between:0,10',
            'informacion_adicional' => 'required|string',
        ];
    }
}