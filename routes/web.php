<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EquipamentoController;

Route::get('/',[IndexController::class,'index']);
Route::get('/equipamentos/{equipamento}',[EquipamentoController::class,'show']);
