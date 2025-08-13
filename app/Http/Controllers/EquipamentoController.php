<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Support\Facades\Gate;

class EquipamentoController extends Controller
{
    public function show(Equipamento $equipamento){

        Gate::authorize('admin');

        $this->authorize('user');
        return view('equipamentos.show',[
           'equipamento' => $equipamento,
        ]);
    }
}
