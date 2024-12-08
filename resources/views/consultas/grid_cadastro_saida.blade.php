@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-entrada-title-container">
    <h1>Registro de Saídas</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_saida/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-filter-container">
    <form method="GET" action="{{ route('consulta_saida') }}">
        <div class="form-row">
            <div class="col">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Filtrar por tipo" value="{{ request()->get('nome') }}">
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
                <a href="{{ route('consulta_saida') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>
</div>

<div class="col-md-10 offset-md-1 grid-entrada-lista-container">
    @if(count($saidas) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Saída</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Origem</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($saidas as $saida)
                    <tr>
                        <td>{{ $saida->id }}</td>
                        <td>{{ $saida->tipoSaida ? $saida->tipoSaida->tipo_saida : 'N/A' }}</td>
                        <td>{{ $saida->valor }}</td>
                        <td>{{ \Carbon\Carbon::parse($saida->data_saida)->format('d/m/Y') }}</td>
                        <td>{{ $saida->membro ? $entrada->membro->nome : 'N/A' }}</td>
                        <td>
                            <a href="/cadastro_saida/{{$saida->id}}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            @if($saida->status == false)
                                <!-- Botão para Ativar -->
                                <form action="{{ route('saida.ativar', $saida->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <ion-icon name="checkmark-outline"></ion-icon> Ativar
                                    </button>
                                </form>
                            @else
                                <!-- Botão para Inativar -->
                                <form action="{{ route('saida.inativar', $saida->id) }}" method="POST" class="d-inline">
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
