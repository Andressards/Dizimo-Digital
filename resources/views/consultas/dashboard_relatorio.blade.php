@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Painel de Controle</h1>

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
        </script>
    </section>
</div>
@endsection
