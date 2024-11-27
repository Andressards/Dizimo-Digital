@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-usuarios-title-container">
    <h1>Lista de Usuários</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_usuario" class="btn btn-primary">
            <ion-icon name="add-outline"></ion-icon> Novo
        </a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-usuarios-filter-container">
    <form method="GET" action="{{ route('usuarios.index') }}">
        <div class="form-row">
            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Filtrar por nome" value="{{ request()->get('nome') }}">
            </div>
            <div class="col d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>

</div>

<div class="col-md-10 offset-md-1 grid-usuarios-lista-container">
    @if($usuarios->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                        <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-info edit-btn">
    <ion-icon name="create-outline"></ion-icon>
</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $usuarios->links() }} <!-- Paginação -->
    @else
        <p>Sem registros</p>
    @endif
</div>

@endsection
