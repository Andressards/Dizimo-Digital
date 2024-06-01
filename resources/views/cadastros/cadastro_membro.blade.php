@extends('layouts.main')

    <div id="membro-create-container" class="create-container">
        <h1 class="titulo-form" id="titulo-form-membro">Cadastrar Membro</h1>
        <form action="/cadastro_membro" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome e sobrenome">
            </div>
            <div class="form-group">
                <label for="title">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX">
            </div>
            <div class="form-group">
                <label for="title">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXX XXX XXX">
            </div>
            <div class="form-group">
                <label for="title">E-mail:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="meuEmail@gmail.com">
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_membro" id="status_membro">
                    <option value="" disabled selected hidden>Selecione</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_membro') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
