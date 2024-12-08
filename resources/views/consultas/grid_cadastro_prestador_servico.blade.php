@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-prestador-servico-title-container">
    <h1>Prestadores de Serviços</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_prestador_servico/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-filter-container">
    <form method="GET" action="{{ route('consulta_prestador_servico') }}">
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
                <a href="{{ route('consulta_prestador_servico') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>
</div>

<div class="col-md-10 offset-md-1 grid-prestador-servico-lista-container">
    @if(count($prestador_servico) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestador_servico as $prestador)
                    <tr>
                        <td>{{$prestador->id}}</td>
                        <td>{{$prestador->nome}}</td>
                        <td>
                            @if($prestador->status == true)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td>
                            <a href="/cadastro_prestador_servico/{{$prestador->id}}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            @if($prestador->status == false)
                                <!-- Botão para Ativar -->
                                <form action="{{ route('prestador_servico.ativar', $prestador->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <ion-icon name="checkmark-outline"></ion-icon> Ativar
                                    </button>
                                </form>
                            @else
                                <!-- Botão para Inativar -->
                                <form action="{{ route('prestador_servico.inativar', $prestador->id) }}" method="POST" class="d-inline">
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
