<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VincularPortaSalaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rack_id' => 'required|exists:racks,id',
            'patch_panel_id' => 'required|exists:patch_panels,id',
            'portas' => 'required|array|min:1',
            'portas.*' => 'integer|min:1',
            'tipos_porta' => 'required|array',
            'tipos_porta.*' => 'nullable|exists:tipo_portas,id'
        ];
    }

    public function messages(): array
    {
        return [
            'rack_id.required' => 'O rack é obrigatório',
            'rack_id.exists' => 'O rack selecionado é inválido',
            'patch_panel_id.required' => 'O patch panel é obrigatório',
            'patch_panel_id.exists' => 'O patch panel selecionado é inválido',
            'portas.required' => 'Selecione pelo menos uma porta',
            'portas.array' => 'O formato das portas é inválido',
            'portas.min' => 'Selecione pelo menos uma porta',
            'portas.*.integer' => 'O número da porta deve ser um número inteiro',
            'portas.*.min' => 'O número da porta deve ser pelo menos 1',
            'tipos_porta.required' => 'Os tipos de porta são obrigatórios',
            'tipos_porta.array' => 'O formato dos tipos de porta é inválido',
            'tipos_porta.*.exists' => 'Tipo de porta inválido'
        ];
    }
}