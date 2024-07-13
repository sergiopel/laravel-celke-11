<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo \'Nome do usuário\' é obrigatório',
            'email.required' => 'O campo \'E-mail do usuário\' é obrigatório',
            'email.email' => 'O campo \'E-mail do usuário\' não está preenchido corretamente',
            'email.unique' => 'O e-mail já está cadastrado!',
        ];
    }
}
