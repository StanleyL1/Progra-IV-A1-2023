<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email',   
            'username'=>'required|unique:users,username',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|min:8|same:password'
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'username.required' => 'El campo nombre de usuario es obligatorio.',
        'username.unique' => 'Este nombre de usuario ya está en uso.',
        'password.required' => 'El campo contraseña es obligatorio.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
        'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
        'password_confirmation.same' => 'La contraseña y la confirmación de la contraseña deben coincidir.',
    ];
}

}
