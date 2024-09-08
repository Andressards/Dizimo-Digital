@extends('layouts.main')

@section('content')
    <div id="membro-edit-container" class="create-container">
    <div class="header-container">
            <h1 class="titulo-form" id="titulo-form-prestador">Atualizar Cadastro de Membross</h1>
        </div>
        <form action="/cadastro_membro/{{$membro->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{$membro->nome}}">
            </div>
            <div class="form-group">
                <label for="title">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" value="{{$membro->cpf}}">
            </div>
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" placeholder="XX/XX/XXXX" value="{{$membro->data_nasc}}">
            </div>
            <div class="form-group">
                <label for="title">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(XX) XXX XXX XXX" value="{{$membro->telefone}}">
            </div>
            <div class="form-group">
                <label for="title">E-mail:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="meuEmail@gmail.com" value="{{$membro->email}}">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{$membro->bairro}}">
            </div>
            <div class="form-group">
                <label for="logradouro">Logradouro:</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Logradouro" value="{{$membro->logradouro}}">
            </div>
            <div class="form-group">
                <label for="estado_membro">Estado:</label>
                <select class="form-control" name="estado_membro" id="estado_membro" required>
                    <option value="" disabled hidden>Selecione</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->uf }}" {{ $membro->uf == $estado->uf ? 'selected' : '' }}>
                            {{ $estado->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cidade_membro">Cidade:</label>
                <select class="form-control" name="cidade_membro" id="cidade_membro" required>
                    <option value="" disabled hidden>Selecione</option>
                    @foreach($cidades as $cidade)
                        <option value="{{ $cidade->id }}" {{ $membro->id_cidade == $cidade->id ? 'selected' : '' }}>
                            {{ $cidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Status</label>
                <select class="form-control" name="status_membro" id="status_membro">
                    <option value="1" {{$membro->status_membro == 1 ? 'selected' : ''}}>Sim</option>
                    <option value="0" {{$membro->status_membro == 0 ? 'selected' : ''}}>Não</option>
                </select>
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Atualizar">
            </div>
            <div class="btn-container">
                <a href="{{ url('/consultas/grid_cadastro_membro') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

    <script>
        function validaCPF() {
            var cpf = document.getElementById("cpf").value;
            cpf = cpf.replace(/[^\d]+/g,''); // Remove tudo que não é número

            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
                alert("CPF inválido.");
                return false;
            }

            var soma = 0;
            var resto;

            for (var i = 1; i <= 9; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) {
                alert("CPF inválido.");
                return false;
            }

            soma = 0;
            for (var i = 1; i <= 10; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }
            resto = (soma * 10) % 11;

            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) {
                alert("CPF inválido.");
                return false;
            }

            return true;
        }
    </script>

@endsection
