<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Predio;
use App\Http\Requests\PredioRequest;

use Illuminate\Support\Facades\Gate;

class PredioController extends Controller
{
    public function index()
    {
        Gate::authorize('admin');
        return view('predios.index',[
            'predios' => Predio::all(), 
         ]);
    }

    public function create()
    {
        Gate::authorize('admin');
        return view('predios.create');
    }

    public function store(PredioRequest $request)
    {
        Gate::authorize('admin');
        Predio::create($request->validated() + ['user_id' => auth()->user()->id]);
        session()->flash('alert-success', 'Prédio criado com sucesso!');
        return redirect('/predios');
    }

    public function show(Predio $predio)
    {
        Gate::authorize('admin');
        return view('predios.show', [
            'predio' => $predio,
            'racks' => $predio->racks,
            'salas' => $predio->salas,
        ]);
    }

    public function edit(Predio $predio)
    {
        Gate::authorize('admin');
        return view('predios.edit', ['predio' => $predio]);
    }

    public function update(PredioRequest $request, Predio $predio)
    {
        Gate::authorize('admin');
        $predio->update($request->validated() + ['updated_by' => auth()->id()]);
        session()->flash('alert-success', 'Prédio atualizado com sucesso!');
        return redirect('/predios');
    }

    public function destroy(Predio $predio)
    {
        Gate::authorize('admin');
        if($predio->salas->isEmpty() && $predio->racks->isEmpty()) {
            \DB::transaction(function () use ($predio) {
            // Preenche quem deletou ANTES de deletar
            $predio->deleted_by = auth()->id();
            $predio->save();
            $predio->delete();
        });
            
        $prediosDeletados = Predio::withTrashed()->get();

        } else {
            session()->flash('alert-danger', 'Prédio não deletado, pois possui salas ou racks cadastrados!');
        }      
        return redirect('/predios');
    }
}
