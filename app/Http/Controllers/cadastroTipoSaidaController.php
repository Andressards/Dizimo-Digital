<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaidaTipo;

class cadastroTipoSaidaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function createTipoSaida() {
        return view('cadastros.cadastro_tipo_saida');
    }

    public function consultaTipoSaida() {
        $tipos_saida = SaidaTipo::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_tipo_saida', ['tipos_saida' => $tipos_saida]);
    }
    

    public function showTipoSaida($id){
        $tipoSaida = SaidaTipo::findOrFail($id);
    
        return view('edicao.cadastro_tipo_saida', compact('tipoSaida'));
    }

    public function storeTipoSaida(Request $request) {
        $saida_tipo = new SaidaTipo;

        $saida_tipo->tipo_saida = $request->tipo_saida;
        $saida_tipo->status = $request->status_tipo_saida;

        $saida_tipo->save();

        return redirect('/consultas/grid_cadastro_tipo_saida')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function destroyTipoSaida($id) {
        SaidaTipo::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_tipo_saida')->with('msg', 'Registro excluido com sucesso!');
    }

    public function updateTipoSaida(Request $request, $id) {
        $saida_tipo = SaidaTipo::findOrFail($id);
        $saida_tipo->tipo_saida = $request->tipo_saida;
        $saida_tipo->status = $request->status_tipo_saida;
        $saida_tipo->save();
    
        return redirect('/consultas/grid_cadastro_tipo_saida')->with('msg', 'Cadastro atualizado com sucesso!');
    }
    
}