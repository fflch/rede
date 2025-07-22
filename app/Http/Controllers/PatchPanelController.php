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

        return redirect("/patch-panels/{$patchPanel->id}");
    }

    public function destroy(PatchPanel $patchPanel)
    {
        $rack_id = $patchPanel->rack_id;
        $patchPanel->delete();

        return redirect("/racks/{$rack_id}");
    }

    public function selecionarSala(PatchPanel $patchPanel)
    {
        $salasPredio = Sala::where('predio_id', $patchPanel->rack->predio_id)->get();
        
        return view('patch-panels.selecionar-sala', [
            'patchPanel' => $patchPanel,
            'salasPredio' => $salasPredio
        ]);
    }

    public function vincularPorta(PatchPanel $patchPanel, Sala $sala)
    {
        // Verifica se a sala pertence ao mesmo prédio
        if ($sala->predio_id != $patchPanel->rack->predio_id) {
            return redirect("/patch-panels/{$patchPanel->id}")->with('error', 'Sala não pertence a este prédio');
        }

        return view('patch-panels.vincular-porta', [
            'patchPanel' => $patchPanel,
            'sala' => $sala
        ]);
    }

    public function vincularSala(VincularPortaRequest $request, PatchPanel $patchPanel)
    {
        // Verifica se a porta já está em uso
        if ($patchPanel->salas()->wherePivot('porta', $request->porta)->exists()) {
            return back()->withErrors(['porta' => 'Esta porta já está vinculada']);
        }

        $patchPanel->salas()->attach($request->sala_id, ['porta' => $request->porta]);
        return redirect("/patch-panels/{$patchPanel->id}")->with('success', 'Porta vinculada com sucesso!');
    }

    public function desvincularSala(PatchPanel $patchPanel, Sala $sala, Request $request)
    {
        // Obter o número da porta da query string
        $porta = $request->query('porta');
        
        if (!$porta) {
            return redirect("/patch-panels/{$patchPanel->id}")->with('error', 'Número da porta não especificado');
        }

        // Remover apenas a vinculação específica (sala + porta)
        $patchPanel->salas()->wherePivot('porta', $porta)->detach($sala->id);
        
        return redirect("/patch-panels/{$patchPanel->id}")->with('success', 'Porta desvinculada com sucesso!');
    }
}