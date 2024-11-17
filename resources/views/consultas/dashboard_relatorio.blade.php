@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Painel de Controle</h1>

    <!-- Filtros e Totais -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('dashboard.entrada') }}" class="d-flex align-items-center mb-4">
                <label for="mes" class="me-2">Filtrar por Mês:</label>
                <input type="month" id="mes" name="mes" class="form-control me-2" value="{{ $filtroMes }}">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total de Entradas</h5>
                    <p class="text-success fs-4">R$ {{ number_format($totalEntrada, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total de Saídas</h5>
                    <p class="text-danger fs-4">R$ {{ number_format($totalSaida, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Saldo</h5>
                    <p class="text-primary fs-4">R$ {{ number_format($saldo, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <section>
        <!-- Gráfico de Saldo de Entrada por Mês (Barras) -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-3"> <!-- Ocupa 1/4 da tela usando col-md-3 -->
                <h4 class="text-center">Saldo de Receita</h4>
                <canvas id="saldoChart" width="200" height="200"></canvas> <!-- Canvas ajustado -->
            </div>

            <!-- Gráfico de Despesas por Mês (Colunas) -->
            <div class="col-md-3"> <!-- Ocupa 1/4 da tela usando col-md-3 -->
                <h4 class="text-center">Saldo de Despesas</h4>
                <canvas id="despesaChart" width="200" height="200"></canvas> <!-- Canvas ajustado -->
            </div>

            <!-- Gráfico de Pizza para Distribuição de Receita e Despesa -->
            <div class="col-md-3"> <!-- Ocupa 1/4 da tela usando col-md-3 -->
                <h4 class="text-center">Distribuição de Movimentação</h4>
                <canvas id="pizzaChart" width="200" height="200"></canvas> <!-- Canvas para o gráfico de pizza -->
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Gráfico de Saldo (Barras)
            const ctx = document.getElementById('saldoChart').getContext('2d');
            const saldoChart = new Chart(ctx, {
                type: 'bar', // Gráfico de barras
                data: {
                    labels: {!! json_encode($months) !!}, // Meses para o eixo X
                    datasets: [{
                        label: 'Saldo de Entrada',
                        data: {!! json_encode($totals) !!}, // Dados de saldo
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Começa o eixo Y no zero
                        }
                    }
                }
            });

            // Gráfico de Despesas (Colunas)
            const ctx2 = document.getElementById('despesaChart').getContext('2d');
            const despesaChart = new Chart(ctx2, {
                type: 'bar', // Gráfico de colunas
                data: {
                    labels: {!! json_encode($despesaMonths) !!}, // Meses para o eixo X
                    datasets: [{
                        label: 'Despesas por Mês',
                        data: {!! json_encode($despesaTotals) !!}, // Dados de despesas
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Começa o eixo Y no zero
                        }
                    }
                }
            });

            // Gráfico de Pizza para Distribuição de Receita e Despesa
            const ctx3 = document.getElementById('pizzaChart').getContext('2d');
            const pizzaChart = new Chart(ctx3, {
                type: 'pie', // Gráfico de pizza
                data: {
                    labels: ['Receita', 'Despesa'], // Rótulos para o gráfico
                    datasets: [{
                        data: [
                            {!! json_encode($porcentoReceita) !!}, // Dados de receita
                            {!! json_encode($porcentoDespesa) !!}  // Dados de despesa
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)', // Cor para receita
                            'rgba(255, 99, 132, 0.6)'  // Cor para despesa
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let total = {!! json_encode($porcentoReceita + $porcentoDespesa) !!};
                                    let value = context.raw;
                                    let percentage = ((value / total) * 100).toFixed(2);
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </section>
</div>
@endsection
