@extends('layouts.main')

@section('content')

    <div id="saida-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-saida">Registrar Saida</h1>
        </div>
        <form action="/cadastro_saida" method="POST">
    @csrf
    <div class="form-group">
        <label for="valor">Valor:</label>
        <input type="number" class="form-control" id="valor_entrada" name="valor" placeholder="R$00,00" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="tipo_entrada">Tipo de Saída:</label>
        <select class="form-control" name="tipo_saida" id="tipo_saida" required>
            <option value="" disabled selected hidden>Selecione</option>
            @foreach($saida_tipos as $saida_tipo)
                <option value="{{ $saida_tipo->id }}">{{ $saida_tipo->tipo_saida }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="prestador_servico">Prestador de Serviço:</label>
        <select class="form-control" name="prestador_servico" id="prestador_servico" required>
            <option value="" disabled selected hidden>Selecione</option>
            @foreach($prestador as $prestador_servico)
                <option value="{{ $prestador_servico->id }}">{{ $prestador_servico->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nome">Descrição:</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição da saída">
    </div>
    <div class="form-group">
        <label for="data_saida">Data de Saída:</label>
        <input type="date" class="form-control" id="data_saida" name="data_saida" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" name="status" id="status" required>
            <option value="" disabled selected hidden>Selecione</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>
    <div class="btn-container">
        <input type="submit" class="btn btn-primary" value="Cadastrar">
    </div>
    <div class="btn-container">
        <a href="{{ url('/consultas/grid_cadastro_saida') }}" class="btn btn-primary">Voltar</a>
    </div>
</form>

    </div>

@endsection
