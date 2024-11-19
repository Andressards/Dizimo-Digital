@extends('layouts.main')

@section('content')

    <div id="prestador_servico-edit-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-prestador">Atualizar Prestador de Serviços</h1>
        </div>
        <form action="/cadastro_prestador_servico/{{$prestador_servico->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="prestador_servico" name="nome" placeholder="Nome" value="{{$prestador_servico->nome}}">
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_prestador_servico') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
