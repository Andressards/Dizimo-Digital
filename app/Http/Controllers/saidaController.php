<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saida;
use App\Models\Membro;
use App\Models\FluxoCaixa;
use App\Models\PrestadorServico;
use App\Models\SaidaTipo;
use Illuminate\Support\Facades\DB;

class SaidaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function createSaida(Request $request) {
        $saida_tipos = SaidaTipo::all();
        $membros = Membro::all();
        $prestador = PrestadorServico::all();
    
        // Retorna a view com os dados atualizados
        return view('cadastros.cadastro_saida', compact('saida_tipos', 'membros', 'prestador'));
    }
    

    public function consultaSaida() {
        $saidas = Saida::with(['tipoSaida', 'membro', 'prestadorServico'])->orderBy('id')->get();
        return view('consultas.grid_cadastro_saida', ['saidas' => $saidas]);
    }

    public function showSaida($id) {
        $saida = Saida::findOrFail($id);
        $saida_tipos = SaidaTipo::all();
        $membros = Membro::all();
        $prestador = PrestadorServico::all();
    
        return view('edicao.cadastro_saida', compact('saida', 'saida_tipos', 'membros', 'prestador'));
    }

    public function storeSaida(Request $request) {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'valor' => 'required|numeric',
            'data_saida' => 'required|date',
            'status' => 'required|boolean',
            'tipo_saida' => 'required|exists:saida_tipo,id',
            'membro' => 'required|exists:membro,id',
            'prestador_servico' => 'required|exists:prestador_servico,id',
        ]);
    
        // Criando um novo registro na tabela 'saida'
        $saida = new Saida();

        $saida->valor = $request->valor;
        $saida->data_saida = $request->data_saida;
        $saida->status = $request->status;
        $saida->id_saida_tipo = $request->tipo_saida; 
        $saida->id_membro = $request->membro;
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
        $novo_saldo = $saldo_atual + $valor_inserido;
    
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
        return redirect('/consultas/grid_cadastro_saida')->with('success', 'Saída registrada com sucesso!');
    }
    

    public function destroySaida($id) {
        Saida::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_saida')->with('msg', 'Registro excluído com sucesso!');
    }

    public function updateSaida(Request $request, $id) {
        $saidas = Saida::findOrFail($id);

        $saidas->valor = $request->valor;
        $saidas->data_saida = $request->data_saida;
        $saidas->status = $request->status;
        $saidas->id_saida_tipo = $request->tipo_saida;
        $saidas->id_membro = $request->membro;
        $saidas->id_prestador_servico = $request->prestador_servico;
        $saidas->descricao_diversos = $request->descricao;

        $saidas->save();
    
        return redirect('/consultas/grid_cadastro_saida')->with('msg', 'Cadastro atualizado com sucesso!');
    }
}
