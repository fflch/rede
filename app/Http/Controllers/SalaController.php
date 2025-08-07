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
        session()->flash('alert-success', 'Sala criada com sucesso!');

        return redirect("/predios/{$request->predio_id}");
    }

    public function show(Sala $sala)
    {
        $patchPanelsVinculados = $sala->patchPanels()
        ->withPivot('porta')
        ->orderBy('patch_panels.nome') 
        ->orderBy('porta', 'asc') 
        ->paginate(10);

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
        session()->flash('alert-success', 'Sala atualizada com sucesso!');

        return redirect("/salas/{$sala->id}");
    }

    public function destroy(Sala $sala)
    {
        $predio_id = $sala->predio_id;
        $sala->delete();
        session()->flash('alert-success', 'Sala removida com sucesso!');

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

    public function selecionarPatchPanel(Sala $sala, Rack $rack, Request $request)
    {
        // Busca todos os patch panels do rack com contagem de portas ocupadas
        $patchPanelsDisponiveis = $rack->patchPanels()
            ->withCount(['salasVinculadas as portas_ocupadas' => function($query) {
                $query->select(\DB::raw('count(distinct porta)'));
            }])
            ->get();

        return view('salas.selecionar-patchpanel', [
            'sala' => $sala,
            'rack' => $rack,
            'patchPanels' => $patchPanelsDisponiveis,
            'selectedPatchPanelId' => $request->patch_panel_id
        ]);
    }

    public function vincularPatchPanel(VincularPortaRequest $request, Sala $sala)
    {
        \DB::beginTransaction();

            $rack = Rack::findOrFail($request->rack_id);
            $patchPanel = PatchPanel::findOrFail($request->patch_panel_id);

            $portas = $request->portas ?? [];
            $vinculos = [];

            foreach ($portas as $porta) {
                $porta = (int) $porta; // Garante que é inteiro

                // Verifica se a porta já está em uso
                $existeVinculo = \DB::table('patch_panel_sala')
                    ->where('patch_panel_id', $patchPanel->id)
                    ->where('porta', $porta)
                    ->exists();

                if (!$existeVinculo) {
                    $vinculos[] = [
                        'porta' => $porta,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            if (!empty($vinculos)) {
                // Insere diretamente na tabela pivot
                \DB::table('patch_panel_sala')->insert(
                    array_map(function($item) use ($patchPanel, $sala) {
                        return array_merge($item, [
                            'patch_panel_id' => $patchPanel->id,
                            'sala_id' => $sala->id
                        ]);
                    }, $vinculos)
                );

                \DB::commit();
                session()->flash('alert-success', 'Portas vinculadas com sucesso!');
                
                return redirect("/salas/{$sala->id}");
            }
    }

    public function desvincularPatchPanel(Sala $sala, PatchPanel $patchPanel, Request $request)
    {
        // Obter o número da porta da query string
        $porta = $request->query('porta');
        
        // Remover apenas a vinculação específica (patch panel + porta)
        $sala->patchPanels()
            ->wherePivot('porta', $porta)
            ->where('patch_panel_id', $patchPanel->id)
            ->detach($patchPanel->id);
        
        session()->flash('alert-success', 'Porta desvinculada com sucesso!');

        return redirect("/salas/{$sala->id}");
    }
}
