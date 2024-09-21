@extends('layouts.main')

@section('content')

    <div id="membro-create-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-membro">Registrar Entrada</h1>
        </div>
        <form action="/cadastro_entrada" method="POST">
            @csrf
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="number" class="form-control" id="valor_entrada" name="valor" placeholder="R$00,00" step="0.01">
            </div>
            <div class="form-group">
                <label for="tipo_entrada">Tipo de Entrada:</label>
                <select class="form-control" name="tipo_entrada" id="tipo_entrada" required>
                    <option value="" disabled selected hidden>Selecione</option>
                    @foreach($entrada_tipos as $entrada_tipo)
                        <option value="{{ $entrada_tipo->id }}">{{ $entrada_tipo->tipo_entrada }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="membro">Nome do Membro:</label>
                <select class="form-control" name="membro" id="membro" required>
                    <option value="" disabled selected hidden>Selecione</option>
                    @foreach($membros as $membro)
                        <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="data_entrada">Data de Entrada:</label>
                <input type="date" class="form-control" id="data_entrada" name="data_entrada" placeholder="XX/XX/XXXX" required>
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
                <a href="{{ url('/consultas/grid_cadastro_entrada') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection
