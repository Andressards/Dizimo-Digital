<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function entrada(Request $request)
    {
        // Filtro por mês (opcional)
        $filtroMes = $request->query('mes'); // Pega o mês do filtro, se existir

        // Consulta para entradas (receita)
        $entradaQuery = DB::table('entrada')
            ->select(DB::raw('SUM(valor) as total_saldo'), DB::raw('DATE_FORMAT(data_entrada, "%m-%Y") as month'))
            ->where('status', '=', 1);
        
        if ($filtroMes) {
            $entradaQuery->where(DB::raw('DATE_FORMAT(data_entrada, "%Y-%m")'), $filtroMes);
        }

        $data = $entradaQuery->groupBy('month')->orderBy('month')->get();

        // Consulta para saídas (despesas)
        $saidaQuery = DB::table('saida')
            ->select(DB::raw('SUM(valor) as total_despesa'), DB::raw('DATE_FORMAT(data_saida, "%m-%Y") as month'))
            ->where('status', '=', 1);
        
        if ($filtroMes) {
            $saidaQuery->where(DB::raw('DATE_FORMAT(data_saida, "%Y-%m")'), $filtroMes);
        }

        $despesas = $saidaQuery->groupBy('month')->orderBy('month')->get();

        // Calcular totais gerais
        $totalEntrada = $data->sum('total_saldo');
        $totalSaida = $despesas->sum('total_despesa');
        $saldo = $totalEntrada - $totalSaida;

        // Cálculo das porcentagens
        $totalGeral = $totalEntrada + $totalSaida;
        $porcentoReceita = $totalGeral > 0 ? ($totalEntrada / $totalGeral) * 100 : 0;
        $porcentoDespesa = $totalGeral > 0 ? ($totalSaida / $totalGeral) * 100 : 0;

        // Últimos 3 valores de entradas
        $ultimasEntradas = DB::table('entrada')
            ->select('valor', 'data_entrada')
            ->where('status', '=', 1)
            ->orderBy('data_entrada', 'desc')
            ->limit(3)
            ->get();

        // Últimos 3 valores de saídas
        $ultimasSaidas = DB::table('saida')
            ->select('valor', 'data_saida')
            ->where('status', '=', 1)
            ->orderBy('data_saida', 'desc')
            ->limit(3)
            ->get();

        // Formatar dados para os gráficos
        $months = $data->pluck('month');
        $totals = $data->pluck('total_saldo');
        $despesaMonths = $despesas->pluck('month');
        $despesaTotals = $despesas->pluck('total_despesa');

        // Enviar para a view
        return view('consultas.dashboard_relatorio', compact(
            'months',
            'totals',
            'despesaMonths',
            'despesaTotals',
            'porcentoReceita',
            'porcentoDespesa',
            'totalEntrada',
            'totalSaida',
            'saldo',
            'ultimasEntradas',
            'ultimasSaidas',
            'filtroMes'
        ));
    }
}