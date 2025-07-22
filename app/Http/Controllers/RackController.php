<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rack;
use App\Models\Predio;
use App\Http\Requests\RackRequest;

class RackController extends Controller
{
    public function create(Request $request)
    {
        $predios = Predio::all();
        $predio_id = $request->input('predio_id');
        
        return view('racks.create', [
            'predios' => $predios,
            'predio_selecionado' => $predio_id
        ]);
    }
    
    public function store(RackRequest $request)
    {
        Rack::create($request->validated());

        return redirect("/predios/{$request->predio_id}");
    }

    public function show(Rack $rack)
    {
        return view('racks.show', [
            'rack' => $rack,
            'equipamentos' => $rack->equipamentos,
            'patchPanels' => $rack->patchPanels,
        ]);
    }

    public function edit(Rack $rack)
    {
        $predios = Predio::all();

        return view('racks.edit', [
            'rack' => $rack,
            'predios' => $predios,
        ]);
    }

    public function update(RackRequest $request, Rack $rack)
    {
        $rack->update($request->validated());

        return redirect("/racks/{$rack->id}");
    }

    public function destroy(Rack $rack)
    {
        $predio_id = $rack->predio_id; // Guarda o ID antes de deletar
        $rack->delete();

        return redirect("/predios/{$predio_id}");
    }
}