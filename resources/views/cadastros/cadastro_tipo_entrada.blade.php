@extends('layouts.main')

    <div id="tipo-entrada-create-container" class="create-container">
        <h1 class="titulo-form" id="titulo-form-tipo-entrada">Cadastrar Tipo de Entrada</h1>
        <form action="/cadastro_tipo_entrada" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Tipo de Entrada:</label>
                <input type="text" class="form-control" id="tipo_entrada" name="tipo_entrada" placeholder="Nome do Tipo de Entrada">
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_tipo_entrada" id="status_tipo_entrada">
                    <option value="" disabled selected hidden>Selecione</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_tipo_entrada') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
