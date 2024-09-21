@extends('layouts.main')

@section('content')

    <div id="membro-edit-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-membro">Edição Entrada</h1>
        </div>
        <form action="/cadastro_entrada/{{ $entrada->id }}" method="POST">
            @csrf
            @method('PUT') <!-- Adiciona o método PUT para atualização -->
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="number" class="form-control" id="valor_entrada" name="valor" placeholder="R$00,00" step="0.01" value="{{ $entrada->valor }}">
            </div>
            <div class="form-group">
                <label for="tipo_entrada">Tipo de Entrada:</label>
                <select class="form-control" name="tipo_entrada" id="tipo_entrada" required>
                    <option value="" disabled hidden>Selecione</option>
                    @foreach($entrada_tipos as $entrada_tipo)
                        <option value="{{ $entrada_tipo->id }}" {{ $entrada_tipo->id == $entrada->id_entrada_tipo ? 'selected' : '' }}>
                            {{ $entrada_tipo->tipo_entrada }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="membro">Nome do Membro:</label>
                <select class="form-control" name="membro" id="membro" required>
                    <option value="" disabled hidden>Selecione</option>
                    @foreach($membros as $membro)
                        <option value="{{ $membro->id }}" {{ $membro->id == $entrada->id_membro ? 'selected' : '' }}>
                            {{ $membro->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="data_entrada">Data de Entrada:</label>
                <input type="date" class="form-control" id="data_entrada" name="data_entrada" value="{{ $entrada->data_entrada }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option value="" disabled selected hidden>Selecione</option>
                    <option value="1" {{ $entrada->status == 1 ? 'selected' : '' }}>Sim</option>
                    <option value="0" {{ $entrada->status == 0 ? 'selected' : '' }}>Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_entrada') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection
