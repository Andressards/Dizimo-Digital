@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-saida-title-container">
    <h1>Tipos de Saída</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_tipo_saida/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-filter-container">
    <form method="GET" action="{{ route('consulta_tipo_saida') }}">
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
                <a href="{{ route('consulta_tipo_saida') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-saida-lista-container">
    @if(count($tipos_saida) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Saída</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos_saida as $saida_tipo)
                    <tr>
                        <td>{{$saida_tipo->id}}</td>
                        <td>{{$saida_tipo->tipo_saida}}</td>
                        <td>
                            @if($saida_tipo->status == 1)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td>
                            <a href="/cadastro_tipo_saida/{{$saida_tipo->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>
                            @if($saida_tipo->status == false)
                                <!-- Botão para Ativar -->
                                <form action="{{ route('saida_tipo.ativar', $saida_tipo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <ion-icon name="checkmark-outline"></ion-icon> Ativar
                                    </button>
                                </form>
                            @else
                                <!-- Botão para Inativar -->
                                <form action="{{ route('saida_tipo.inativar', $saida_tipo->id) }}" method="POST" class="d-inline">
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