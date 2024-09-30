<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Para usar a consulta DB

class DashboardController extends Controller
{
    public function entrada()
    {
        // Consulta para obter saldo por mês
        $data = DB::table('entrada')
            ->select(DB::raw('SUM(valor) as total_saldo'), DB::raw('DATE_FORMAT(data_entrada, "%m-%Y") as month'))
            ->where('status', '=', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Consulta para obter despesas por mês
        $despesas = DB::table('saida')
            ->select(DB::raw('SUM(valor) as total_despesa'), DB::raw('DATE_FORMAT(data_saida, "%m-%Y") as month'))
            ->where('status', '=', 1)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Formatar dados para o gráfico de saldo
        $months = $data->pluck('month');
        $totals = $data->pluck('total_saldo');

        // Formatar dados para o gráfico de despesas
        $despesaMonths = $despesas->pluck('month');
        $despesaTotals = $despesas->pluck('total_despesa');

        return view('consultas.dashboard_relatorio', compact('months', 'totals', 'despesaMonths', 'despesaTotals')); // Renderiza a view com os dados
    }
}
