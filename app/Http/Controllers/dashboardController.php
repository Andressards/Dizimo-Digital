<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Para usar a consulta DB

class DashboardController extends Controller
{
    public function index()
    {
        // Consulta para obter saldo por mês
        $data = DB::table('fluxo_caixa')
            ->select(DB::raw('SUM(saldo) as total_saldo'), DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'))
            ->where('id_entrada', '>', 0)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Formatar dados para o gráfico
        $months = $data->pluck('month');
        $totals = $data->pluck('total_saldo');

        return view('consultas.dashboard_relatorio', compact('months', 'totals')); // Renderiza a view com os dados
    }
}
