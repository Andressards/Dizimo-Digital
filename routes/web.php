<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login'); // Redireciona para a página de login
});

use App\Http\Controllers\dashboardController; // Importa o controller

// Rota para o dashboard
Route::get('/consultas/dashboard_relatorio', [dashboardController::class, 'entrada'])->name('dashboard.relatorio');

// Rota para o método 'entrada' do DashboardController
Route::get('/dashboard/entrada', [DashboardController::class, 'entrada'])->name('dashboard.entrada');


use App\Http\Controllers\cadastroTipoEntradaController;

Route::get('/cadastros/cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'createTipoEntrada']);
Route::post('/cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'store']);
Route::get('/consultas/grid_cadastro_tipo_entrada', [cadastroTipoEntradaController::class, 'index'])->name('consulta_tipo_entrada');
Route::get('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'showTipoEntrada']);
Route::delete('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'destroyTipoEntrada']);
Route::put('/cadastro_tipo_entrada/{id}', [cadastroTipoEntradaController::class, 'update']);
Route::post('/cadastro_tipo_entrada/{id}/ativar', [cadastroTipoEntradaController::class, 'ativar'])->name('entrada_tipo.ativar');
Route::post('/cadastro_tipo_entrada/{id}/inativar', [cadastroTipoEntradaController::class, 'inativar'])->name('entrada_tipo.inativar');


use App\Http\Controllers\cadastroTipoSaidaController;

Route::get('/cadastros/cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'createTipoSaida']);
Route::post('/cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'storeTipoSaida']);
Route::get('/consultas/grid_cadastro_tipo_saida', [cadastroTipoSaidaController::class, 'index'])->name('consulta_tipo_saida');
Route::get('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'showTipoSaida']);
Route::delete('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'destroyTipoSaida']);
Route::put('/cadastro_tipo_saida/{id}', [cadastroTipoSaidaController::class, 'updateTipoSaida']);
Route::post('/cadastro_tipo_saida/{id}/ativar', [cadastroTipoSaidaController::class, 'ativar'])->name('saida_tipo.ativar');
Route::post('/cadastro_tipo_saida/{id}/inativar', [cadastroTipoSaidaController::class, 'inativar'])->name('saida_tipo.inativar');


use App\Http\Controllers\cadastroMembroController;

Route::get('/cadastros/cadastro_membro', [cadastroMembroController::class, 'createMembro']);
Route::post('/cadastro_membro', [cadastroMembroController::class, 'storeMembro']);
Route::get('/consultas/grid_cadastro_membro', [cadastroMembroController::class, 'index'])->name('consulta_cadastro_membro');
Route::get('/cadastro_membro/{id}', [cadastroMembroController::class, 'showMembro']);
Route::delete('/cadastro_membro/{id}', [cadastroMembroController::class, 'destroyMembro']);
Route::put('/cadastro_membro/{id}', [cadastroMembroController::class, 'updateMembro']);
Route::post('/cadastro_membro/ativar/{id}', [cadastroMembroController::class, 'ativar'])->name('membro.ativar');
Route::post('/cadastro_membro/inativar/{id}', [cadastroMembroController::class, 'inativar'])->name('membro.inativar');

use App\Http\Controllers\cadastroPrestadorServicoController;

Route::get('/cadastros/cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'createPrestadorServico']);
Route::post('/cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'storePrestadorServico']);
Route::get('/consultas/grid_cadastro_prestador_servico', [cadastroPrestadorServicoController::class, 'index'])->name('consulta_prestador_servico');
Route::get('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'showPrestadorServico']);
Route::delete('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'destroyPrestadorServico']);
Route::put('/cadastro_prestador_servico/{id}', [cadastroPrestadorServicoController::class, 'updatePrestadorServico']);
Route::post('/prestador_servico/ativar/{id}', [cadastroPrestadorServicoController::class, 'ativar'])->name('prestador_servico.ativar');
Route::post('/prestador_servico/inativar/{id}', [cadastroPrestadorServicoController::class, 'inativar'])->name('prestador_servico.inativar');


use App\Http\Controllers\estadoCidadeController;

// Rota para carregar estados e cidades
Route::get('/estados_cidades', [estadoCidadeController::class, 'index']);

use App\Http\Controllers\EntradaController;

Route::get('/cadastros/cadastro_entrada', [EntradaController::class, 'createEntrada']);
Route::post('/cadastro_entrada', [EntradaController::class, 'storeEntrada']);
Route::get('/consultas/grid_cadastro_entrada', [EntradaController::class, 'consultaEntrada']);
Route::get('/cadastro_entrada/{id}', [EntradaController::class, 'showEntrada']);
Route::delete('/cadastro_entrada/{id}', [EntradaController::class, 'destroyEntrada']);
Route::put('/cadastro_entrada/{id}', [EntradaController::class, 'updateEntrada']);
Route::post('/cadastro_entrada/ativar/{id}', [EntradaController::class, 'ativar'])->name('entrada.ativar');
Route::post('/cadastro_entrada/inativar/{id}', [EntradaController::class, 'inativar'])->name('entrada.inativar');

use App\Http\Controllers\SaidaController;

Route::get('/cadastros/cadastro_saida', [SaidaController::class, 'createSaida']);
Route::post('/cadastro_saida', [SaidaController::class, 'storeSaida']);
Route::get('/consultas/grid_cadastro_saida', [SaidaController::class, 'consultaSaida']);
Route::get('/cadastro_saida/{id}', [SaidaController::class, 'showSaida']);
Route::delete('/cadastro_saida/{id}', [SaidaController::class, 'destroySaida']);
Route::put('/cadastro_saida/{id}', [SaidaController::class, 'updateSaida']);
Route::post('/cadastro_saida/ativar/{id}', [SaidaController::class, 'ativar'])->name('saida.ativar');
Route::post('/cadastro_saida/inativar/{id}', [SaidaController::class, 'inativar'])->name('saida.inativar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
