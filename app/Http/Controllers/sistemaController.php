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
        return view('consultas.grid_tipo_entrada');
    }

    public function store(Request $request) {
        $entrada_tipo = new EntradaTipo;

        $entrada_tipo->tipo_entrada = $request->tipo_entrada;
        $entrada_tipo->status = $request->status_tipo_entrada;

        $entrada_tipo->save();

        return redirect('/')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function destroy($id) {
        EntradaTipo::findOrFail($id)->delete();
        return redirect('/')->with('msg', 'Registro excluido com sucesso!');
    }
}