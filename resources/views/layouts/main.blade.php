<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dízimo Digital</title>

    <!-- Fonte do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Script do Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbar">
            <a href="/" class="navbar-brand">
                <img src="/img/Sara-nossa-terra-logo.png" alt="Dízimo Digital">
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/consultas/dashboard_relatorio" class="nav-link">Relatórios</a>
                </li>
                <li class="nav-item">
                    <a href="/consultas/grid_cadastro_membro" class="nav-link">Cadastrar Membro</a>
                </li>
                <li class="nav-item">
                    <a href="/consultas/grid_cadastro_prestador_servico" class="nav-link">Prestador de Serviços</a>
                </li>
                <li class="nav-item">
                    <a href="/consultas/grid_cadastro_entrada" class="nav-link">Registrar Entrada</a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">Registrar Saída</a>
                </li>
                <li class="nav-item">
                    <a href="/consultas/grid_cadastro_tipo_entrada" class="nav-link">Tipo de Entrada</a>
                </li>
                <li class="nav-item">
                    <a href="/consultas/grid_cadastro_tipo_saida" class="nav-link">Tipo de Saída</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">Novo Usuário</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" class="nav-link"
                           onclick="event.preventDefault();
                           this.closest('form').submit();">Sair</a>
                    </form>
                </li>
            </ul>
            <navbar-brand></navbar-brand>
        </div>
    </nav>
</header>
<main class="d-flex flex-column">
    <div class="container-fluid flex-grow-1">
        <div class="row">
            @if(session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            @yield('content')
        </div>
    </div>
</main>

<footer class="mt-auto">
    <p>Dízimo Digital</p>
</footer>

</body>
</html>
