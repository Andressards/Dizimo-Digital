<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\sistemaController;


Route::get('/', [sistemaController::class, 'index']);
Route::get('/consultas/grid_tipo_entrada', [sistemaController::class, 'consultaTipoEntrada']); // ????
Route::get('/cadastros/cadastro_tipo_entrada', [sistemaController::class, 'createTipoEntrada']);
Route::post('/cadastro_tipo_entrada', [sistemaController::class, 'store']);
Route::get('/cadastros/cadastro_tipo_saida', [sistemaController::class, 'createTipoSaida']);
Route::post('/cadastro_tipo_saida', [sistemaController::class, 'storeTipoSaida']);
Route::delete('/cadastro_tipo_entrada/{id}', [sistemaController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';