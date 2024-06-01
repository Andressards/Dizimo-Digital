@extends('layouts.main')

@section('content')
    <div id="membro-edit-container" class="create-container">
        <h1 class="titulo-form" id="titulo-form-membro">Editar Cadastro de Membro</h1>
        <form action="/cadastro_membro/{{$membro->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{$membro->nome}}">
            </div>
            <div class="form-group">
                <label for="title">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" value="{{$membro->cpf}}">
            </div>
            <div class="form-group">
                <label for="title">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXX XXX XXX" value="{{$membro->telefone}}">
            </div>
            <div class="form-group">
                <label for="title">E-mail:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="meuEmail@gmail.com" value="{{$membro->email}}">
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_membro" id="status_membro">
                    <option value="1" {{$membro->status_membro == 1 ? 'selected' : ''}}>Sim</option>
                    <option value="0" {{$membro->status_membro == 0 ? 'selected' : ''}}>Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_membro') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
