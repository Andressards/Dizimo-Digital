@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-saida-title-container">
    <h1>Tipos de Saída</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_tipo_saida/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
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
                            <form action="/cadastro_tipo_saida/{{$saida_tipo->id}}" method="POST">
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