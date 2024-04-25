<?php

use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tool', [ToolController::class, 'index'])->name('PCTool'); 

Route::post('/tool/calcular-e-devolver-densidade', [ToolController::class, 'calcularEDevolverDensidade']);
