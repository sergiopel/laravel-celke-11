<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            //'course_id' => 'required',
            //só faço a validação se o id do curso for enviado
            'course_id' => 'required_if:course_id,!=,null',
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Necessário enviar o id do curso!',
            'name.required' => 'Nome é obrigatório',
            'description.required' => 'Descrição é obrigatória',
        ];
    }
}
