@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-entrada-title-container">
    <h1>Tipos de Entrada</h1>
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
                        <td scropt="row">{{$loop->index + 1}}</td>
                        <td><a href="/cadastro_tipo_entrada/{{$entrada_tipo->id}}">{{$entrada_tipo->tipo_entrada}}</a></td>
                        <td>{{$entrada_tipo->status}}</td>
                        <td><a href="#">Editar</a> <a href="#">Deletar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Sem registros, <a href="/cadastros/cadastro_tipo_entrada">cadastrar</a></p>
    @endif
</div>

@endsection