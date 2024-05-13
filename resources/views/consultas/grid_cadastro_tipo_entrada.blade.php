@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-entrada-title-container">
    <h1>Tipos de Entrada</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_tipo_entrada/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
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
                        <td>{{$entrada_tipo->status}}</td>
                        <td>
                            <a href="/cadastro_tipo_entrada/{{$entrada_tipo->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>
                            <form action="/cadastro_tipo_entrada/{{$entrada_tipo->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
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