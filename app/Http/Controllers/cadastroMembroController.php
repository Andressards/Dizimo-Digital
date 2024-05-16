<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;

class cadastroMembroController extends Controller
{
    public function createMembro() {
        return view('cadastros.cadastro_membro');
    }

    public function storeMembro(Request $request) {
        $membro = new Membro;

        $membro->nome = $request->nome;
        $membro->cpf = $request->cpf;
        $membro->email = $request->email;
        $membro->telefone = $request->telefone;
        $membro->status = $request->status_membro;

        $membro->save();

        return redirect('/consultas/grid_cadastro_tipo_entrada')->with('msg', 'Cadastro criado com sucesso!');
    }    
}