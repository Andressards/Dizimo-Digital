<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrestadorServico;

class cadastroPrestadorServicoController extends Controller
{
    public function createPrestadorServico() {
        return view('cadastros.cadastro_prestador_servico');
    }

    public function consultaPrestadorServico() {
        $prestador_servico = PrestadorServico::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_prestador_servico', ['prestador_servico' => $prestador_servico]);
    }

    public function showPrestadorServico($id){
        $prestador_servico = PrestadorServico::findOrFail($id);
    
        return view('edicao.cadastro_prestador_servico', compact('prestador_servico'));
    }

    public function storePrestadorServico(Request $request) {
        $prestador_servico = new PrestadorServico;

        $prestador_servico->nome = $request->nome;
        $prestador_servico->status = $request->status;

        $prestador_servico->save();

        return redirect('/consultas/grid_cadastro_prestador_servico')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function destroyPrestadorServico($id) {
        PrestadorServico::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_prestador_servico')->with('msg', 'Registro excluido com sucesso!');
    }

    public function updatePrestadorServico(Request $request, $id) {
        $prestador_servico = PrestadorServico::findOrFail($id);
        $prestador_servico->nome = $request->nome;
        $prestador_servico->status = $request->status;
        $prestador_servico->save();
    
        return redirect('/consultas/grid_cadastro_prestador_servico')->with('msg', 'Cadastro atualizado com sucesso!');
    }
    
    public function index(Request $request)
    {
        // Captura o filtro de nome e status
        $nome = $request->input('nome');
        $status = $request->input('status');

        // Filtra os registros
        $prestador_servico = PrestadorServico::query();

        if ($nome) {
            $prestador_servico->where('nome', 'like', '%' . $nome . '%');
        }

        if (isset($status)) {
            $prestador_servico->where('status', $status);
        }

        $prestador_servico = $prestador_servico->get();

        // Retorna a view com as variáveis de filtro e dados dos prestadores
        return view('consultas.grid_cadastro_prestador_servico', compact('prestador_servico', 'nome', 'status'));
    }

    public function ativar($id)
    {
        $prestador_servico = PrestadorServico::findOrFail($id);
        $prestador_servico->status = true;
        $prestador_servico->save();

        return redirect()->back()->with('success', 'Registro ativado com sucesso!');
    }

    public function inativar($id)
    {
        $prestador_servico = PrestadorServico::findOrFail($id);
        $prestador_servico->status = false;
        $prestador_servico->save();

        return redirect()->back()->with('success', 'Registro inativado com sucesso!');
    }
}