@extends('layouts.main')

@section('content')

    <div id="prestador-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-prestador">Cadastrar Prestador de Serviços</h1>
        </div>
        <form action="/cadastro_prestador_servico" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="" disabled selected hidden>Selecione</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_prestador_servico') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection
