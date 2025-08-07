<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatchPanel;
use App\Models\Rack;
use App\Models\Sala;
use App\Http\Requests\PatchPanelRequest;
use App\Http\Requests\VincularPortaRequest;

class PatchPanelController extends Controller
{
    public function create(Request $request)
    {
        $racks = Rack::all();
        $rack_id = $request->input('rack_id');
        
        return view('patch-panels.create', [
            'racks' => $racks,
            'rack_selecionado' => $rack_id
        ]);
    }

    public function store(PatchPanelRequest $request)
    {
        $patchPanel = PatchPanel::create($request->validated());
        session()->flash('alert-success', 'Patch panel criado com sucesso!');
        return redirect("/racks/{$patchPanel->rack_id}");
    }

    public function show(PatchPanel $patchPanel)
    {
        $salasPredio = Sala::where('predio_id', $patchPanel->rack->predio_id)->get();

        return view('patch-panels.show', [
            'patchPanel' => $patchPanel,
            'salas' => $patchPanel->salas,
            'salasPredio' => $salasPredio,
        ]);
    }

    public function edit(PatchPanel $patchPanel)
    {
        $racks = Rack::all();

        return view('patch-panels.edit', [
            'patchPanel' => $patchPanel,
            'racks' => $racks,
        ]);
    }

    public function update(PatchPanelRequest $request, PatchPanel $patchPanel)
    {
        $patchPanel->update($request->validated());
        session()->flash('alert-success', 'Patch panel atualizado com sucesso!');
        return redirect("/patch-panels/{$patchPanel->id}");
    }

    public function destroy(PatchPanel $patchPanel)
    {
        $rack_id = $patchPanel->rack_id;
        
        $patchPanel->delete();
        session()->flash('alert-success', 'Patch panel removido com sucesso!');
        return redirect("/racks/{$rack_id}");
    }

    public function selecionarSala(PatchPanel $patchPanel, Request $request)
    {
        $porta = $request->query('porta');

        $salasPredio = Sala::where('predio_id', $patchPanel->rack->predio_id)->get();
        
        return view('patch-panels.selecionar-sala', [
            'patchPanel' => $patchPanel,
            'salasPredio' => $salasPredio,
            'porta' => $porta
        ]);
    }

    public function vincularSala(VincularPortaRequest $request, PatchPanel $patchPanel)
    {
        $patchPanel->salas()->attach($request->sala_id, ['porta' => $request->porta]);
        session()->flash('alert-success', 'Porta vinculada com sucesso!');
        return redirect("/patch-panels/{$patchPanel->id}");
    }

    public function desvincularSala(PatchPanel $patchPanel, Sala $sala, Request $request)
    {
        $porta = $request->query('porta');
        
        $patchPanel->salas()->wherePivot('porta', $porta)->detach($sala->id);
        session()->flash('alert-success', 'Porta desvinculada com sucesso!');
        return redirect("/patch-panels/{$patchPanel->id}");
    }
}