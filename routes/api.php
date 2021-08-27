<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SnapshotController;

Route::post('snapshot',[SnapshotController::class,'snapshot']);
