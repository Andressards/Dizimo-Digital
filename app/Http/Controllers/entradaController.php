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
    public function createEntrada(Request $request) {
        $entrada_tipos = EntradaTipo::all();
        $membros = Membro::all();
    
        // Retorna a view com os dados atualizados
        return view('cadastros.cadastro_entrada', compact('entrada_tipos', 'membros'));
    }
    
    public function consultaEntrada(Request $request) {
        $query = Entrada::with(['tipoEntrada', 'membro']);
    
        // Filtro por nome do tipo de entrada
        if ($request->filled('nome')) {
            $query->whereHas('tipoEntrada', function ($q) use ($request) {
                $q->where('tipo_entrada', 'LIKE', '%' . $request->nome . '%');
            });
        }
    
        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $entradas = $query->orderBy('id')->get();
    
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
            'tipo_entrada' => 'required|exists:entrada_tipo,id',
            'membro' => 'required|exists:membro,id', // Corrigido para 'membros'
        ]);
    
        // Criando um novo registro na tabela 'Entrada'
        $entrada = new Entrada;
        $entrada->valor = $request->valor;
        $entrada->data_entrada = $request->data_entrada;
        $entrada->status = true;
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
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'valor' => 'required|numeric',
            'data_entrada' => 'required|date',
            'tipo_entrada' => 'required|exists:entrada_tipo,id',
            'membro' => 'required|exists:membro,id',
        ]);
    
        // Busca a entrada existente no banco de dados
        $entrada = Entrada::findOrFail($id);
    
        // Obtém o valor antigo para recalcular o saldo
        $valor_antigo = $entrada->valor;
    
        // Atualiza os campos da entrada
        $entrada->valor = $request->valor;
        $entrada->data_entrada = $request->data_entrada;
        $entrada->id_entrada_tipo = $request->tipo_entrada;
        $entrada->id_membro = $request->membro;
        $entrada->save();
    
        // Recupera o saldo atual do fluxo de caixa
        $saldo_atual = FluxoCaixa::orderBy('id', 'desc')->first()->saldo ?? 0;
    
        // Calcula o novo saldo considerando a diferença entre o valor antigo e o novo
        $diferenca_valor = $request->valor - $valor_antigo;
        $novo_saldo = $saldo_atual + $diferenca_valor;
    
        // Atualiza o fluxo de caixa
        DB::beginTransaction();
    
        try {
            // Insere um novo registro no fluxo de caixa com o saldo atualizado
            DB::insert('INSERT INTO fluxo_caixa (saldo, id_entrada, created_at) VALUES (?, ?, ?)', [$novo_saldo, $entrada->id, now()]);
    
            // Confirma a transação
            DB::commit();
        } catch (\Exception $e) {
            // Desfaz a transação em caso de erro
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao atualizar a entrada.');
        }
    
        // Redireciona após sucesso
        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Cadastro atualizado com sucesso!');
    }
    

    public function ativar($id)
    {
        $entradas = Entrada::findOrFail($id);
        $entradas->status = true;
        $entradas->save();

        return redirect()->route('consulta_entrada')->with('success', 'Registro ativado com sucesso!');
    }

    public function inativar($id)
    {
        $entradas = Entrada::findOrFail($id);
        $entradas->status = false;
        $entradas->save();

        return redirect()->route('consulta_entrada')->with('success', 'Registro inativado com sucesso!');
    }
}