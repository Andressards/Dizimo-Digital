<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\EntradaTipo;
use App\Models\Estado;
use App\Models\Membro;

class EntradaController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function createEntrada() {
        $entrada_tipos = EntradaTipo::all();
        $membros = Membro::all();
        return view('cadastros.cadastro_entrada', compact('entrada_tipos', 'membros'));
    }

    public function consultaEntrada() {
        $entradas = Entrada::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_entrada', ['entradas' => $entradas]);
    }
    

    public function showEntrada($id){
        $entradas = Entrada::findOrFail($id);
    
        return view('edicao.cadastro_entrada', compact('entradas'));
    }

    public function storeEntrada(Request $request) {
        $entradas = new Entrada;

        $entradas->valor = $request->valor;
        $entradas->data_entrada = $request->data_entrada;
        $entradas->status = $request->status;
        $entradas->id_entrada_tipo = $request->tipo_entrada;
        $entradas->id_membro = $request->membro;

        $entradas->save();

        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Cadastro criado com sucesso!');
    }

    public function destroyEntrada($id) {
        Entrada::findOrFail($id)->delete();
        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Registro excluido com sucesso!');
    }

    public function updateEntrada(Request $request, $id) {
        $entradas = Entrada::findOrFail($id);

        $entradas->valor = $request->valor;
        $entradas->data_entrada = $request->data_entrada;
        $entradas->status = $request->status;
        $entradas->id_entrada_tipo = $request->tipo_entrada;
        $entradas->id_membro = $request->membro;

        $entradas->save();
    
        return redirect('/consultas/grid_cadastro_entrada')->with('msg', 'Cadastro atualizado com sucesso!');
    }
    
}