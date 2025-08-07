<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PredioRequest extends FormRequest
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
        $rules = [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('predios')->ignore($this->predio->id ?? null)->where(function ($query) {
                    return $query->whereRaw('LOWER(nome) = ?', [strtolower($this->nome)]);
                })
            ],
            'descricao' => 'nullable|string'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do prédio é obrigatório',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres',
            'nome.unique' => 'Já existe um prédio com este nome',
        ];
    }
}