<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\cadastroTipoEntradaController;

Route::get('/', [cadastroTipoEntradaController::class, 'index']);

Route::get('/cadastros/cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'createTipoEntrada']);
Route::post('/cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'store']);
Route::get('/consultas/grid_cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'consultaTipoEntrada']);
Route::get('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'showTipoEntrada']);
Route::delete('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'destroyTipoEntrada']);
Route::put('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'updateTipoEntrada']);

use App\Http\Controllers\cadastroTipoSaidaController;

Route::get('/cadastros/cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'createTipoSaida']);
Route::post('/cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'storeTipoSaida']);
Route::get('/consultas/grid_cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'consultaTipoSaida']);
Route::get('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'showTipoSaida']);
Route::delete('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'destroyTipoSaida']);
Route::put('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'updateTipoSaida']);

use App\Http\Controllers\cadastroMembroController;

Route::get('/cadastros/cadastro_membro', [cadastroMembroController::class, 'createMembro']);
Route::post('/cadastro_membro', [cadastroMembroController::class, 'storeMembro']);
Route::get('/consultas/grid_cadastro_membro', [cadastroMembroController::class, 'consultaMembro']);
Route::get('/cadastro_membro/{id}', [cadastroMembroController::class, 'showMembro']);
Route::delete('/cadastro_membro/{id}', [cadastroMembroController::class, 'destroyMembro']);
Route::put('/cadastro_membro/{id}', [cadastroMembroController::class, 'updateMembro']);

use App\Http\Controllers\cadastroPrestadorServicoController;

Route::get('/cadastros/cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'createPrestadorServico']);
Route::post('/cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'storePrestadorServico']);
Route::get('/consultas/grid_cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'consultaPrestadorServico']);
Route::get('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'showPrestadorServico']);
Route::delete('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'destroyPrestadorServico']);
Route::put('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'updatePrestadorServico']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
