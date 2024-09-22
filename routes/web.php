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

use App\Http\Controllers\estadoCidadeController;

// Rota para membros
Route::get('/cadastro_membro', [cadastroMembroController::class, 'createMembro']);

Route::get('/cadastro_tipo_entrada', [cadastroMembroController::class, 'createEntrada']);

// Rota para carregar estados e cidades
Route::get('/estados_cidades', [estadoCidadeController::class, 'index']);

use App\Http\Controllers\EntradaController;

Route::get('/cadastros/cadastro_entrada', [EntradaController::class, 'createEntrada']);
Route::post('/cadastro_entrada', [EntradaController::class, 'storeEntrada']);
Route::get('/consultas/grid_cadastro_entrada', [EntradaController::class, 'consultaEntrada']);
Route::get('/cadastro_entrada/{id}', [EntradaController::class, 'showEntrada']);
Route::delete('/cadastro_entrada/{id}', [EntradaController::class, 'destroyEntrada']);
Route::put('/cadastro_entrada/{id}', [EntradaController::class, 'updateEntrada']);

use App\Http\Controllers\SaidaController;

Route::get('/cadastros/cadastro_saida', [SaidaController::class, 'createSaida']);
Route::post('/cadastro_saida', [SaidaController::class, 'storeSaida']);
Route::get('/consultas/grid_cadastro_saida', [SaidaController::class, 'consultaSaida']);
Route::get('/cadastro_saida/{id}', [SaidaController::class, 'showSaida']);
Route::delete('/cadastro_saida/{id}', [SaidaController::class, 'destroySaida']);
Route::put('/cadastro_saida/{id}', [SaidaController::class, 'updateSaida']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
