<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaidaTipo;

class cadastroTipoSaidaController extends Controller
{
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
 
    public function index(Request $request)
    {
        $query = SaidaTipo::query();

        if ($request->filled('nome')) {
            $query->where('tipo_saida', 'like', '%' . $request->input('nome') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tipos_saida = $query->get();

        return view('consultas.grid_cadastro_tipo_saida', compact('tipos_saida'));
    }

    public function ativar($id)
    {
        $saida_tipo = SaidaTipo::findOrFail($id);
        $saida_tipo->status = true;
        $saida_tipo->save();

        return redirect()->back()->with('success', 'Registro ativado com sucesso!');
    }

    public function inativar($id)
    {
        $saida_tipo = SaidaTipo::findOrFail($id);
        $saida_tipo->status = false;
        $saida_tipo->save();

        return redirect()->back()->with('success', 'Registro inativado com sucesso!');
    }
}