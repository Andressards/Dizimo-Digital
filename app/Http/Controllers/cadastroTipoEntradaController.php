<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaTipo;

class cadastroTipoEntradaController extends Controller
{
    public function createTipoEntrada() {
        return view('cadastros.cadastro_tipo_entrada');
    }

    public function consultaTipoEntrada() {
        $tipos_entrada = EntradaTipo::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_tipo_entrada', ['tipos_entrada' => $tipos_entrada]);
    }
    

    public function showTipoEntrada($id){
        $tipoEntrada = EntradaTipo::findOrFail($id);
    
        return view('edicao.cadastro_tipo_entrada', compact('tipoEntrada'));
    }

    public function store(Request $request) {
        $entrada_tipo = new EntradaTipo;

        $entrada_tipo->tipo_entrada = $request->tipo_entrada;
        $entrada_tipo->status = $request->status_tipo_entrada;

        $entrada_tipo->save();

        return redirect('/consultas/grid_cadastro_tipo_entrada')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function destroyTipoEntrada($id) {
        EntradaTipo::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_tipo_entrada')->with('msg', 'Registro excluido com sucesso!');
    }

    public function updateTipoEntrada(Request $request, $id) {
        $tipoEntrada = EntradaTipo::findOrFail($id);
        $tipoEntrada->tipo_entrada = $request->tipo_entrada;
        $tipoEntrada->status = $request->status_tipo_entrada;
        $tipoEntrada->save();
    
        return redirect('/consultas/grid_cadastro_tipo_entrada')->with('msg', 'Cadastro atualizado com sucesso!');
    }

    public function index(Request $request)
    {
        $query = EntradaTipo::query();

        if ($request->filled('nome')) {
            $query->where('tipo_entrada', 'like', '%' . $request->input('nome') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tipos_entrada = $query->get();

        return view('consultas.grid_cadastro_tipo_entrada', compact('tipos_entrada'));
    }
 
    public function ativar($id)
    {
        $entrada_tipo = EntradaTipo::findOrFail($id);
        $entrada_tipo->status = true;
        $entrada_tipo->save();

        return redirect()->back()->with('success', 'Registro ativado com sucesso!');
    }

    public function inativar($id)
    {
        $entrada_tipo = EntradaTipo::findOrFail($id);
        $entrada_tipo->status = false;
        $entrada_tipo->save();

        return redirect()->back()->with('success', 'Registro inativado com sucesso!');
    }

}