@extends('layouts.main')

@section('content')

<div class="col-md-10 offset-md-1 grid-tipo-saida-title-container">
    <h1>Cadastro de Membros</h1>
    <div class="btn-container">
        <a href="/cadastros/cadastro_membro/" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon>Novo</a>
    </div>
</div>

<div class="col-md-10 offset-md-1 grid-tipo-entrada-filter-container">
    <form method="GET" action="{{ route('consulta_cadastro_membro') }}">
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
                <a href="{{ route('consulta_cadastro_membro') }}" class="btn btn-secondary">Limpar</a>
            </div>
        </div>
    </form>
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
                            @if($membro->status == false)
                                <!-- Botão para Ativar -->
                                <form action="{{ route('membro.ativar', $membro->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <ion-icon name="checkmark-outline"></ion-icon> Ativar
                                    </button>
                                </form>
                            @else
                                <!-- Botão para Inativar -->
                                <form action="{{ route('membro.inativar', $membro->id) }}" method="POST" class="d-inline">
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