@extends('layouts.main')

@section('content')
    <div id="tipo-entrada-edit-container" class="edit-container">
        <h1 class="titulo-form" id="titulo-form-tipo-entrada">Editar Tipo de Entrada</h1>
        <form action="/cadastro_tipo_entrada/{{$tipoEntrada->id}}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT para enviar o método HTTP PUT para atualização -->
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
        </form>
    </div>
@endsection
