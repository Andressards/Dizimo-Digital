<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saida;
use App\Models\FluxoCaixa;
use App\Models\PrestadorServico;
use App\Models\SaidaTipo;
use Illuminate\Support\Facades\DB;

class SaidaController extends Controller
{
    public function createSaida(Request $request) {
        $saida_tipos = SaidaTipo::all();
        $prestador = PrestadorServico::all();
    
        // Retorna a view com os dados atualizados
        return view('cadastros.cadastro_saida', compact('saida_tipos', 'prestador'));
    }
    
    public function consultaSaida(Request $request) {
        $query = Saida::with(['tipoSaida', 'membro']);
    
        // Filtro por nome do tipo de saída
        if ($request->filled('nome')) {
            $query->whereHas('tipoSaida', function ($q) use ($request) {
                $q->where('tipo_saida', 'LIKE', '%' . $request->nome . '%');
            });
        }
    
        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $saidas = $query->orderBy('id')->get();
    
        return view('consultas.grid_cadastro_saida', ['saidas' => $saidas]);
    }    

    public function showSaida($id) {
        $saida = Saida::findOrFail($id);
        $saida_tipos = SaidaTipo::all();
        $prestador = PrestadorServico::all();
    
        return view('edicao.cadastro_saida', compact('saida', 'saida_tipos', 'prestador'));
    }

    public function storeSaida(Request $request) {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'valor' => 'required|numeric',
            'data_saida' => 'required|date',
            'tipo_saida' => 'required|exists:saida_tipo,id',
            'prestador_servico' => 'required|exists:prestador_servico,id',
        ]);
    
        // Criando um novo registro na tabela 'saida'
        $saida = new Saida();

        $saida->valor = $request->valor;
        $saida->data_saida = $request->data_saida;
        $saida->status = true;
        $saida->id_saida_tipo = $request->tipo_saida;
        $saida->id_prestador_servico = $request->prestador_servico;
        $saida->descricao_diversos = $request->descricao;
    
        // Salvando o registro no banco de dados
        $saida->save();
    
        // Recupera o ID da saida recém-criada
        $id_saida = $saida->id;
    
        // Obtém o saldo atual do fluxo de caixa
        $saldo_atual = FluxoCaixa::orderBy('id', 'desc')->first()->saldo ?? 0; 
        $valor_inserido = $request->valor;
    
        // Calcula o novo saldo
        $novo_saldo = $saldo_atual - $valor_inserido;
    
        // Inserindo o saldo atualizado no fluxo de caixa
        DB::beginTransaction();
    
        try {
            // Inserindo o novo saldo no fluxo de caixa
            DB::insert('INSERT INTO fluxo_caixa (saldo, id_saida, created_at) VALUES (?, ?, ?)', [$novo_saldo, $id_saida, now()]);
    
            // Confirma a transação
            DB::commit();
        } catch (\Exception $e) {
            // Desfaz a transação em caso de erro
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao processar a saída.');
        }
    
        // Redireciona após sucesso
        return redirect('/consultas/grid_cadastro_saida')->with('msg', 'Saída registrada com sucesso!');
    }
    

    public function destroySaida($id) {
        Saida::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_saida')->with('msg', 'Registro excluído com sucesso!');
    }

    public function updateSaida(Request $request, $id) {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'valor' => 'required|numeric',
            'data_saida' => 'required|date',
            'tipo_saida' => 'required|exists:saida_tipo,id',
            'prestador_servico' => 'required|exists:prestador_servico,id',
            'descricao' => 'nullable|string',
        ]);
    
        // Busca a saída existente no banco de dados
        $saida = Saida::findOrFail($id);
    
        // Obtém o valor antigo para recalcular o saldo
        $valor_antigo = $saida->valor;
    
        // Atualiza os campos da saída
        $saida->valor = $request->valor;
        $saida->data_saida = $request->data_saida;
        $saida->id_saida_tipo = $request->tipo_saida;
        $saida->id_prestador_servico = $request->prestador_servico;
        $saida->descricao_diversos = $request->descricao;
        $saida->save();
    
        // Recupera o saldo atual do fluxo de caixa
        $saldo_atual = FluxoCaixa::orderBy('id', 'desc')->first()->saldo ?? 0;
    
        // Calcula o novo saldo considerando a diferença entre o valor antigo e o novo
        $diferenca_valor = $valor_antigo - $request->valor;
        $novo_saldo = $saldo_atual + $diferenca_valor;
    
        // Atualiza o fluxo de caixa
        DB::beginTransaction();
    
        try {
            // Insere um novo registro no fluxo de caixa com o saldo atualizado
            DB::insert('INSERT INTO fluxo_caixa (saldo, id_saida, created_at) VALUES (?, ?, ?)', [$novo_saldo, $saida->id, now()]);
    
            // Confirma a transação
            DB::commit();
        } catch (\Exception $e) {
            // Desfaz a transação em caso de erro
            DB::rollback();
            return back()->with('error', 'Ocorreu um erro ao atualizar a saída.');
        }
    
        // Redireciona após sucesso
        return redirect('/consultas/grid_cadastro_saida')->with('msg', 'Cadastro atualizado com sucesso!');
    }
    

    public function ativar($id)
    {
        $saidas = Saida::findOrFail($id);
        $saidas->status = true;
        $saidas->save();

        return redirect()->back()->with('success', 'Registro ativado com sucesso!');
    }

    public function inativar($id)
    {
        $saidas = Saida::findOrFail($id);
        $saidas->status = false;
        $saidas->save();

        return redirect()->back()->with('success', 'Registro inativado com sucesso!');
    }
}
