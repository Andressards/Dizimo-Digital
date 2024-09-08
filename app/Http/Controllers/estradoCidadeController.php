<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Cidade;

class EstadoCidadeController extends Controller
{
    public function index() {
        $estados = Estado::all();
        $cidades = Cidade::all();
        return view('cadastros.cadastro_membro', compact('estados', 'cidades'));
    }
}
