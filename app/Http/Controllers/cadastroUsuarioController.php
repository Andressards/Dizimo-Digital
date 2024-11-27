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
    return view('cadastros.cadastro_usuario', compact('usuario')); // Ou a view correspondente
}

public function update(Request $request, $id)
{
    // Validação dos dados
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Excluindo o próprio usuário da validação de email único
        'password' => 'nullable|string|min:8|confirmed', // Senha opcional
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $usuario = User::findOrFail($id);
    
    // Atualiza os dados do usuário
    $usuario->name = $request->name;
    $usuario->email = $request->email;
    
    // Se a senha foi preenchida, atualiza a senha
    if ($request->filled('password')) {
        $usuario->password = Hash::make($request->password);
    }

    $usuario->save();

    return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
}

}