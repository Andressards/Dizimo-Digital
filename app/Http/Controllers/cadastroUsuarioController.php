<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class cadastroUsuarioController extends Controller
{
    public function create()
    {
        return view('cadastros.cadastro_usuario'); // Exibe o formulário de registro
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criação do usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('cadastros.cadastro_usuario')->with('success', 'Usuário registrado com sucesso!');
    }

    public function index(Request $request)
    {
        $nome = $request->get('nome');

        $usuarios = User::query()
            ->when($nome, function ($query, $nome) {
                $query->where('name', 'LIKE', "%{$nome}%");
            })
            ->paginate(10);

        // Altere para o caminho correto da view
        return view('consultas.grid_cadastro_usuario', compact('usuarios'));
    }

    public function consultaUsuario() {
        $usuarios = User::orderBy('id')->get();
    
        return view('consultas.grid_cadastro_tipo_usuario', ['user' => $usuarios]);
    }  

        public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('edicao.cadastro_usuario', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $usuario = User::findOrFail($id);

        // Atualiza os dados
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        // Redireciona para a lista de usuários
        return redirect()->route('usuarios.index')->with('msg', 'Usuário atualizado com sucesso!');
    }


}