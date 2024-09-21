@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-entrada-title-container">
    <h1>Registro de Entradas</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_entrada/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>
<div class="col-md-10 offset-md-1 grid-entrada-lista-container">
    @if(count($entradas) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tipo de Entrada</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Origem</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entradas as $entrada)
                    <tr>
                        <td>{{ $entrada->id }}</td>
                        <td>{{ $entrada->tipoEntrada ? $entrada->tipoEntrada->tipo_entrada : 'N/A' }}</td>
                        <td>{{ $entrada->valor }}</td>
                        <td>{{ \Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
                        <td>{{ $entrada->membro ? $entrada->membro->nome : 'N/A' }}</td>
                        <td>
                            <a href="/cadastro_entrada/{{$entrada->id}}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            
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
