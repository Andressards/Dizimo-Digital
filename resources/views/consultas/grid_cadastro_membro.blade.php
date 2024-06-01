@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-saida-title-container">
    <h1>Cadastro de Membros</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_membro/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>
<div class="col-md-10 offset-md-1 grid-membro-lista-container">
    @if(count($membro) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($membro as $membro)
                    <tr>
                        <td>{{$membro->id}}</td>
                        <td>{{$membro->nome}}</td>
                        <td>{{$membro->email}}</td>
                        <td>{{$membro->telefone}}</td>
                        <td>{{$membro->cpf}}</td>
                        <td>
                            @if($membro->status_membro != 1)
                                Ativo
                            @else
                                Inativo
                            @endif
                        </td>
                        <td>
                            <a href="/cadastro_membro/{{$membro->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon></a>
                            
                            
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