<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SnapshotController;
use App\Http\Controllers\Api\EquipamentoController;

Route::post('equipamentos',[EquipamentoController::class,'store']);

Route::post('snapshot',[SnapshotController::class,'snapshot']);
