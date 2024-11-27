@extends('layouts.main')

@section('content')

    <div id="tipo-entrada-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-tipo-entrada">Cadastrar Usuário</h1>
        </div>
            <form method="POST" action="{{ route('usuario.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_usuario') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection