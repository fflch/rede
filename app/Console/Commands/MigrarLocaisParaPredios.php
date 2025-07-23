<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Equipamento;
use App\Models\Predio;
use App\Models\Rack;

class MigrarLocaisParaPredios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrar:locais-para-predios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migra os dados antigos de local e position para as novas tabelas predios e racks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Primeiro, migramos os locais para prédios
        $locaisUnicos = Equipamento::select('local')
            ->distinct()
            ->whereNotNull('local')
            ->get()
            ->pluck('local')
            ->filter();

        $this->info("Encontrados {$locaisUnicos->count()} locais distintos para migrar.");

        foreach ($locaisUnicos as $local) {
            // Verifica se o prédio já existe
            $predio = Predio::firstOrCreate(
                ['nome' => $local],
                ['descricao' => ' ']
            );

            $this->info("Prédio '{$local}' criado ou encontrado (ID: {$predio->id})");

            // Agora migramos as positions (racks) para este prédio
            $positionsUnicas = Equipamento::where('local', $local)
                ->select('position')
                ->distinct()
                ->whereNotNull('position')
                ->get()
                ->pluck('position')
                ->filter();

            foreach ($positionsUnicas as $position) {
                // Verifica se o rack já existe para este prédio
                $rack = Rack::firstOrCreate(
                    [
                        'nome' => $position,
                        'predio_id' => $predio->id
                    ]
                );

                $this->info("  Rack '{$position}' criado ou encontrado (ID: {$rack->id})");

                // Atualiza os equipamentos com os IDs corretos
                $atualizados = Equipamento::where('local', $local)
                    ->where('position', $position)
                    ->update([
                        'predio_id' => $predio->id,
                        'rack_id' => $rack->id
                    ]);

                $this->info("    {$atualizados} equipamentos atualizados para Prédio: {$predio->id}, Rack: {$rack->id}");
            }
        }

        $this->info('Migração concluída com sucesso!');
    }
}