@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-entrada-title-container">
    <h1>Tipos de Entrada</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_tipo_entrada/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-filter-container">
    <form method="GET" action="{{ route('consulta_tipo_entrada') }}">
        <div class="form-row">
            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Filtrar por nome" value="{{ request()->get('nome') }}">
            </div>
            <div class="col">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Filtrar por status</option>
                    <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>
            <div class="col d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
                <a href="{{ route('consulta_tipo_entrada') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-lista-container">
    @if(count($tipos_entrada) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Entrada</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos_entrada as $entrada_tipo)
                    <tr>
                        <td>{{$entrada_tipo->id}}</td>
                        <td>{{$entrada_tipo->tipo_entrada}}</td>
                        <td>
                            @if($entrada_tipo->status == 1)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td>
                            <a href="/cadastro_tipo_entrada/{{$entrada_tipo->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>
                            @if($entrada_tipo->status == false)
    <!-- Botão para Ativar -->
    <form action="{{ route('entrada_tipo.ativar', $entrada_tipo->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">
            <ion-icon name="checkmark-outline"></ion-icon> Ativar
        </button>
    </form>
@else
    <!-- Botão para Inativar -->
    <form action="{{ route('entrada_tipo.inativar', $entrada_tipo->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-warning">
            <ion-icon name="close-outline"></ion-icon> Inativar
        </button>
    </form>
@endif


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Sem registros</p>
    @endif
</div>

@endsection
