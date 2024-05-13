<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaTipo;

class sistemaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function createTipoEntrada() {
        return view('cadastros.cadastro_tipo_entrada');
    }

    public function consultaTipoEntrada() {
        $tipos_entrada = EntradaTipo::all();

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
}