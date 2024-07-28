@extends('layouts.main')

@section('content')

    <div id="membro-create-container" class="create-container">
        <h1 class="titulo-form" id="titulo-form-membro">Cadastrar Membro</h1>
        <form action="/cadastro_membro" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome e sobrenome">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX">
            </div>
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" placeholder="XX/XX/XXXX" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXX XXX XXX">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="meuEmail@gmail.com">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
            </div>
            <div class="form-group">
                <label for="logradouro">Logradouro:</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro">
            </div>
            <div class="form-group">
                <label for="estado_membro">Estado:</label>
                <select class="form-control" name="estado_membro" id="estado_membro" required>
                    <option value="" disabled selected hidden>Selecione</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->uf }}">{{ $estado->estado }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cidade_membro">Cidade:</label>
                <select class="form-control" name="cidade_membro" id="cidade_membro" required>
                    <option value="" disabled selected hidden>Selecione</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id_cidade }}">{{ $cidade->cidade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status_membro">Status:</label>
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

@endsection
