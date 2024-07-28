<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Models\Estado;
use App\Models\Cidade;

class cadastroMembroController extends Controller
{
    public function createMembro() {
        // Recupera todos os estados do banco de dados
        $estados = Estado::all();
        $cidades = Cidade::all();

        // Passa os estados para a view
        return view('cadastros.cadastro_membro', compact('estados', 'cidades'));
    }

    public function storeMembro(Request $request) {
        $membro = new Membro;

        $membro->nome = $request->nome;
        $membro->cpf = $request->cpf;
        $membro->email = $request->email;
        $membro->telefone = $request->telefone;
        $membro->data_nasc = $request->data_nasc;
        $membro->bairro = $request->bairro;
        $membro->logradouro = $request->logradouro;
        $membro->id_cidade = $request->cidade_membro;
        $membro->uf = $request->estado_membro;
        $membro->status = $request->status_membro;

        $membro->save();

        return redirect('/consultas/grid_cadastro_membro')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function consultaMembro() {
        $membro = Membro::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_membro', ['membro' => $membro]);
    }
    
    public function destroyMembro($id) {
        Membro::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_membro')->with('msg', 'Registro excluído com sucesso!');
    }

    public function updateMembro(Request $request, $id) {
        $membro = Membro::findOrFail($id);

        $membro->nome = $request->nome;
        $membro->cpf = $request->cpf;
        $membro->email = $request->email;
        $membro->telefone = $request->telefone;
        $membro->data_nasc = $request->data_nasc;
        $membro->bairro = $request->bairro;
        $membro->logradouro = $request->logradouro;
        $membro->id_cidade = $request->cidade_membro;
        $membro->uf = $request->estado_membro;
        $membro->status = $request->status_membro;

        $membro->save();
    
        return redirect('/consultas/grid_cadastro_membro')->with('msg', 'Cadastro atualizado com sucesso!');
    }

    public function showMembro($id){
        $membro = Membro::findOrFail($id);
    
        return view('edicao.cadastro_membro', compact('membro'));
    }
}