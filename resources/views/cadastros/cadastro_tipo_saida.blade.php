@extends('layouts.main')

@section('content')

    <div id="tipo-saida-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-tipo-saida">Cadastrar Tipo de Saída</h1>
        </div>
        <form action="/cadastro_tipo_saida" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Tipo de Saída:</label>
                <input type="text" class="form-control" id="tipo_saida" name="tipo_saida" placeholder="Nome do Tipo de Saída">
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_tipo_saida" id="status_tipo_saida">
                    <option value="" disabled selected hidden>Selecione</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_tipo_saida') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection