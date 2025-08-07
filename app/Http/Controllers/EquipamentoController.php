<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamento;
use Illuminate\Support\Facades\Gate;

class EquipamentoController extends Controller
{
    public function show(Request $request, Equipamento $equipamento){
        
        Gate::authorize('admin');

        $this->authorize('user');
        return view('equipamentos.show',[
           'equipamento' => $equipamento, 
        ]);
    }
}
