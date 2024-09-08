@extends('layouts.main')

@section('content')
    <div id="tipo-entrada-edit-container" class="create-container">
        <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-tipo-entrada">Editar Tipo de Entrada</h1>
        </div>
        <form action="/cadastro_tipo_entrada/{{$tipoEntrada->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tipo de Entrada:</label>
                <input type="text" class="form-control" id="tipo_entrada" name="tipo_entrada" placeholder="Nome do Tipo de Entrada" value="{{$tipoEntrada->tipo_entrada}}">
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_tipo_entrada" id="status_tipo_entrada">
                    <option value="1" {{$tipoEntrada->status == 1 ? 'selected' : ''}}>Sim</option>
                    <option value="0" {{$tipoEntrada->status == 0 ? 'selected' : ''}}>Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_tipo_entrada') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@endsection
