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

    public function showTipoEntrada($id)
    {
        // Carregue o tipo de entrada com o ID fornecido
        $tipoEntrada = EntradaTipo::findOrFail($id); // Supondo que você esteja usando o Eloquent ORM
        
        // Retorne a view com os detalhes do tipo de entrada
        return view('edicao.cadastro_tipo_entrada', compact('tipoEntrada'));
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