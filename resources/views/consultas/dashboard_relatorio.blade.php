@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Painel de Controle</h1>

    <section>
      <!-- Gráfico de Saldo de Entrada por Mês -->
      <div class="row justify-content-center mt-4">
          <div class="col-md-10">
              <h2 class="text-center">Saldo de Entrada por Mês</h2>
              <canvas id="saldoChart" width="400" height="200"></canvas> <!-- Canvas para o gráfico -->
          </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
          const ctx = document.getElementById('saldoChart').getContext('2d');
          const saldoChart = new Chart(ctx, {
              type: 'bar', // Tipo de gráfico
              data: {
                  labels: {!! json_encode($months) !!}, // Rótulos dos meses
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
                          beginAtZero: true // Começa no zero
                      }
                  }
              }
          });
      </script>
    </section>
    
</div>
@endsection
