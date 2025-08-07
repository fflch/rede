<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\PatchPanelController;

Route::get('/',[IndexController::class,'index']);
Route::get('/equipamentos/{equipamento}',[EquipamentoController::class,'show']);

// Prédios
Route::get('/predios/create', [PredioController::class, 'create']);
Route::post('/predios', [PredioController::class, 'store']);
Route::get('/predios/{predio}', [PredioController::class, 'show']);
Route::get('/predios/{predio}/edit', [PredioController::class, 'edit']);
Route::put('/predios/{predio}', [PredioController::class, 'update']);
Route::delete('/predios/{predio}', [PredioController::class, 'destroy']);

// Salas
Route::get('/salas/create', [SalaController::class, 'create']);
Route::post('/salas', [SalaController::class, 'store']);
Route::get('/salas/{sala}', [SalaController::class, 'show']);
Route::get('/salas/{sala}/edit', [SalaController::class, 'edit']);
Route::put('/salas/{sala}', [SalaController::class, 'update']);
Route::delete('/salas/{sala}', [SalaController::class, 'destroy']);

// Racks
Route::get('/racks/create', [RackController::class, 'create']);
Route::post('/racks', [RackController::class, 'store']);
Route::get('/racks/{rack}', [RackController::class, 'show']);
Route::get('/racks/{rack}/edit', [RackController::class, 'edit']);
Route::put('/racks/{rack}', [RackController::class, 'update']);
Route::delete('/racks/{rack}', [RackController::class, 'destroy']);

// Patch Panels
Route::get('/patch-panels/create', [PatchPanelController::class, 'create']);
Route::post('/patch-panels', [PatchPanelController::class, 'store']);
Route::get('/patch-panels/{patchPanel}', [PatchPanelController::class, 'show']);
Route::get('/patch-panels/{patchPanel}/edit', [PatchPanelController::class, 'edit']);
Route::put('/patch-panels/{patchPanel}', [PatchPanelController::class, 'update']);
Route::delete('/patch-panels/{patchPanel}', [PatchPanelController::class, 'destroy']);

// Vincular portas de patch panels a salas
Route::get('/patch-panels/{patchPanel}/selecionar-sala', [PatchPanelController::class, 'selecionarSala']);
Route::post('/patch-panels/{patchPanel}/vincular-sala', [PatchPanelController::class, 'vincularSala']);
Route::delete('/patch-panels/{patchPanel}/desvincular-sala/{sala}', [PatchPanelController::class, 'desvincularSala']);

// Vincular salas a patch panels
Route::get('/salas/{sala}/selecionar-rack', [SalaController::class, 'selecionarRack']);
Route::get('/salas/{sala}/selecionar-patchpanel/{rack}', [SalaController::class, 'selecionarPatchPanel']);
Route::post('/salas/{sala}/vincular-patchpanel', [SalaController::class, 'vincularPatchPanel']);
Route::delete('/salas/{sala}/desvincular-patchpanel/{patchPanel}', [SalaController::class, 'desvincularPatchPanel']);