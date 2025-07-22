<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VincularPortaRequest extends FormRequest
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
            'porta' => 'required|integer|min:1'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'porta.required' => 'O número da porta é obrigatório',
            'porta.integer' => 'O número da porta deve ser um número inteiro',
            'porta.min' => 'O número da porta deve ser pelo menos 1'
        ];
    }
}
