@extends('layouts.main')

@section('content')
    <div id="tipo-entrada-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-tipo-entrada">Editar Usuário</h1>
        </div>
        <form method="POST" action="{{ route('usuario.update', $usuario->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name}}" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Deixe em branco se não quiser alterar a senha.</small>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            <div class="btn-container">

            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_usuario') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection
