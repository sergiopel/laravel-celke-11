<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            //'price' => 'required|regex:/^\d{1,8}(\,\d{1,2})?$/',
            //a linha regex acima diz que aceita apenas números com no màximo 8 inteiros e 2 casas decimais
            //e usa a virgula como separador
            'price' => 'required|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo \'Nome do Curso\' é obrigatório',
            'price.required' => 'O campo \'Preço do Curso\' é obrigatório',
            'price.max' => 'O preço só pode ter no máximo 8 números!',
            //'price.regex' => 'O campo \'Preço do Curso\' deve ser um número com até 8 inteiros e 2 casas decimais (use a vírgula como separador)',
        ];
    }
}
