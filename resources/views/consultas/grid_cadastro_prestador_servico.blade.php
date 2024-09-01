@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-prestador-servico-title-container">
    <h1>Prestadores de Serviços</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_prestador_servico/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
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
                            @if($prestador->status == 1)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td>
                            <a href="/cadastro_prestador_servico/{{$prestador->id}}" class="btn btn-info edit-btn">
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
