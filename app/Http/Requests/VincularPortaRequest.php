<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VincularPortaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Se a rota for de patch panel (vincular-sala)
        if (str_contains($this->path(), 'patch-panels')) {
            return [
                'sala_id' => 'required|exists:salas,id',
                'porta' => 'required|integer|min:1'
            ];
        }
        
        // Se a rota for de sala (vincular-patchpanel)
        return [
            'rack_id' => 'required|exists:racks,id',
            'patch_panel_id' => 'required|exists:patch_panels,id',
            'portas' => 'required|array|min:1',
            'portas.*' => 'integer|min:1'
        ];
    }

    public function messages(): array
    {
        return [
            // Mensagens para vincular-sala
            'sala_id.required' => 'A sala é obrigatória',
            'sala_id.exists' => 'sala inválida',
            'porta.required' => 'O número da porta é obrigatório',
            'porta.integer' => 'O número da porta deve ser um número inteiro',
            'porta.min' => 'O número da porta deve ser pelo menos 1',
            
            // Mensagens para vincular-patchpanel
            'rack_id.required' => 'O rack é obrigatório',
            'rack_id.exists' => 'O rack selecionado é inválido',
            'patch_panel_id.required' => 'O patch panel é obrigatório',
            'patch_panel_id.exists' => 'O patch panel selecionado é inválido',
            'portas.required' => 'Selecione pelo menos uma porta',
            'portas.array' => 'O formato das portas é inválido',
            'portas.min' => 'Selecione pelo menos uma porta',
            'portas.*.integer' => 'O número da porta deve ser um número inteiro',
            'portas.*.min' => 'O número da porta deve ser pelo menos 1'
        ];
    }
}