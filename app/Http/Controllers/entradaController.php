<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\EntradaTipo;
use App\Models\Estado;
use App\Models\Membro;
use App\Models\FluxoCaixa;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function createEntrada(Request $request) {
        $entrada_tipos = EntradaTipo::all();
        $membros = Membro::all();
    
        // Retorna a view com os dados atualizados
        return view('cadastros.cadastro_entrada', compact('entrada_tipos', 'membros'));
    }
    

    public function consultaEntrada() {
        $entradas = Entrada::with(['tipoEntrada', 'membro'])->orderBy('id')->get();
        return view('consultas.grid_cadastro_entrada', ['entradas' => $entradas]);
    }

    public function showEntrada($id) {
        $entrada = Entrada::findOrFail($id);
        $entrada_tipos = EntradaTipo::all();
        $membros = Membro::all();
    
        return view('edicao.cadastro_entrada', compact('entrada', 'entrada_tipos', 'membros'));
    }

    public function storeEntrada(Request $request) {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'valor' => 'required|numeric',
            'data_entrada' => 'required|date',
            'status' => 'required|boolean',
            'tipo_entrada' => 'required|exists:entrada_tipo,id',
            'membro' => 'required|exists:membro,id', // Corrigido para 'membros'
        ]);
    
        // Criando um novo registro na tabela 'Entrada'
        $entrada = new Entrada;
        $entrada->valor = $request->valor;
        $entrada->data_entrada = $request->data_entrada;
        $entrada->status = $request->status;
        $entrada->id_entrada_tipo = $request->tipo_entrada; 
        $entrada->id_membro = $request->membro;
    
        // Salvando o registro no banco de dados
        $entrada->save();
    
        // Recupera o ID da entrada recém-criada
        $id_entrada = $entrada->id;
    
        // Obtém o saldo atual do fluxo de caixa
        $saldo_atual = FluxoCaixa::orderBy('id', 'desc')->first()->saldo ?? 0; 
        $valor_inserido = $request->valor;
    
        // Calcula o novo saldo
        $novo_saldo = $saldo_atual + $valor_inserido;
    
        // Inserindo o saldo atualizado no fluxo de caixa
        DB::beginTransaction();
    
        try {
            // Inserindo o novo saldo no fluxo de caixa
            DB::insert('INSERT INTO fluxo_caixa (saldo, id_entrada, created_at) VALUES (?, ?, ?)', [$novo_saldo, $id_entrada, now()]);
    
            // Confirma a transação
            DB::commit();
        } catch (\Exception $e) {
            // Desfaz a transação em caso de erro
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao processar a entrada.');
        }
    
        // Redireciona após sucesso
        return redirect('/consultas/grid_cadastro_entrada')->with('success', 'Entrada registrada com sucesso!');
    }
    

    public function destroyEntrada($id) {
        Entrada::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Registro excluído com sucesso!');
    }

    public function updateEntrada(Request $request, $id) {
        $entradas = Entrada::findOrFail($id);

        $entradas->valor = $request->valor;
        $entradas->data_entrada = $request->data_entrada;
        $entradas->status = $request->status;
        $entradas->id_entrada_tipo = $request->tipo_entrada;
        $entradas->id_membro = $request->membro;

        $entradas->save();
    
        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Cadastro atualizado com sucesso!');
    }
}
