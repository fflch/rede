<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use App\Models\Predio;
use App\Models\PatchPanel;
use App\Models\Rack;
use App\Http\Requests\SalaRequest;
use App\Http\Requests\VincularPortaRequest;

class SalaController extends Controller
{
    public function create(Request $request)
    {
        $predios = Predio::all();
        $predio_id = $request->input('predio_id');
        
        return view('salas.create', [
            'predios' => $predios,
            'predio_selecionado' => $predio_id
        ]);
    }

    public function store(SalaRequest $request)
    {
        Sala::create($request->validated());

        return redirect("/predios/{$request->predio_id}");
    }

    public function show(Sala $sala)
    {
        $patchPanelsVinculados = $sala->patchPanels()->withPivot('porta')->get();
        $racks = $sala->predio->racks;

        return view('salas.show', [
            'sala' => $sala,
            'patchPanels' => $patchPanelsVinculados,
            'racks' => $racks
        ]);
    }

    public function edit(Sala $sala)
    {
        $predios = Predio::all();

        return view('salas.edit', [
            'sala' => $sala,
            'predios' => $predios,
        ]);
    }

    public function update(SalaRequest $request, Sala $sala)
    {
        $sala->update($request->validated());

        return redirect("/salas/{$sala->id}");
    }

    public function destroy(Sala $sala)
    {
        $predio_id = $sala->predio_id;
        $sala->delete();

        return redirect("/predios/{$predio_id}");
    }

    public function selecionarRack(Sala $sala)
    {
        $racks = $sala->predio->racks;
        
        return view('salas.selecionar-rack', [
            'sala' => $sala,
            'racks' => $racks
        ]);
    }

    public function selecionarPatchPanel(Sala $sala, Rack $rack)
    {
        // Verifica se o rack pertence ao mesmo prédio da sala
        if ($rack->predio_id != $sala->predio_id) {
            return redirect("/salas/{$sala->id}")->with('error', 'Rack não pertence a este prédio');
        }

        // Busca todos os patch panels do rack
        $patchPanelsDisponiveis = $rack->patchPanels;

        return view('salas.selecionar-patchpanel', [
            'sala' => $sala,
            'rack' => $rack,
            'patchPanels' => $patchPanelsDisponiveis
        ]);
    }

    public function vincularPatchPanel(VincularPortaRequest $request, Sala $sala)
    {
        $rack = Rack::findOrFail($request->rack_id);
        $patchPanel = PatchPanel::findOrFail($request->patch_panel_id);

        // Verifica se pertencem ao mesmo prédio
        if ($rack->predio_id != $sala->predio_id || $patchPanel->rack_id != $rack->id) {
            return redirect("/salas/{$sala->id}")->with('error', 'Seleção inválida');
        }

        // Verifica se a porta já está em uso NESTE PATCH PANEL
        if ($patchPanel->salas()->wherePivot('porta', $request->porta)->exists()) {
            return back()->withErrors(['porta' => 'Esta porta já está vinculada a outra sala']);
        }

        // Verifica se já existe esta mesma porta vinculada à mesma sala 
        if ($sala->patchPanels()
            ->where('patch_panel_id', $patchPanel->id)
            ->wherePivot('porta', $request->porta)
            ->exists()) {
            return back()->withErrors(['porta' => 'Esta porta já está vinculada a esta sala']);
        }

        $sala->patchPanels()->attach($patchPanel->id, ['porta' => $request->porta]);

        return redirect("/salas/{$sala->id}")->with('success', 'Porta vinculada com sucesso!');
    }

    public function desvincularPatchPanel(Sala $sala, PatchPanel $patchPanel, Request $request)
    {
        // Obter o número da porta da query string
        $porta = $request->query('porta');
        
        if (!$porta) {
            return redirect("/salas/{$sala->id}")->with('error', 'Número da porta não especificado');
        }

        // Remover apenas a vinculação específica (patch panel + porta)
        $sala->patchPanels()
            ->wherePivot('porta', $porta)
            ->where('patch_panel_id', $patchPanel->id)
            ->detach($patchPanel->id);
        
        return redirect("/salas/{$sala->id}")->with('success', 'Porta desvinculada com sucesso!');
    }
}
