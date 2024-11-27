@extends('layouts.main')

@section('content')

    <div id="tipo-entrada-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-tipo-entrada">Editar Usuário</h1>
        </div>

        <!-- Alterei o método para PUT ou PATCH para indicar edição -->
        <form method="POST" action="{{ route('usuario.update', $usuario->id) }}">
            @csrf
            @method('PUT') <!-- Usando PUT para indicar que é uma atualização -->

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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

            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

@endsection
