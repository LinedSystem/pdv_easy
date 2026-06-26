@extends('layouts.app')

@section('title', 'Dashboard - PDV Easy')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    
    <!-- Welcome Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight leading-none">
                Bem-vindo de volta!
            </h1>
            <p class="text-sm text-slate-500 font-light mt-1">
                Aqui está o resumo operacional do PDV Easy para hoje.
            </p>
        </div>
        <div>
            <!-- Botão Ação Rápida (Nova Venda) -->
            <button class="inline-flex items-center justify-center px-4.5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all cursor-pointer">
                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Abrir Caixa / Nova Venda
            </button>
        </div>
    </div>

    <!-- Grid de Cards de Métricas (Vazios para Testes) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Faturamento Operacional</span>
                <div class="p-2 rounded-lg bg-indigo-50 text-indigo-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="h-7 w-28 bg-slate-100 rounded-lg animate-pulse"></div>
                <div class="h-3 w-16 bg-slate-50 rounded animate-pulse"></div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Transações Efetuadas</span>
                <div class="p-2 rounded-lg bg-emerald-50 text-emerald-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="h-7 w-20 bg-slate-100 rounded-lg animate-pulse"></div>
                <div class="h-3 w-20 bg-slate-50 rounded animate-pulse"></div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Itens em Alerta de Estoque</span>
                <div class="p-2 rounded-lg bg-rose-50 text-rose-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <div class="space-y-1">
                <div class="h-7 w-16 bg-slate-100 rounded-lg animate-pulse"></div>
                <div class="h-3 w-24 bg-slate-50 rounded animate-pulse"></div>
            </div>
        </div>

    </div>

    <!-- Info Alert (Multi-Tenant Environment Connected) -->
    <div class="p-4 bg-indigo-50/50 border border-indigo-100/50 rounded-2xl flex items-start space-x-3.5">
        <div class="p-1.5 bg-indigo-600 text-white rounded-lg">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h4 class="text-xs font-bold text-indigo-900">Ambiente de Testes Multitenancy Ativo</h4>
            <p class="text-[11px] text-indigo-700/80 leading-relaxed mt-0.5">
                Este caixa está operando isoladamente dentro da base virtual da empresa <span class="font-semibold">{{ auth()->user()->tenant->nome_empresa }}</span>. Nenhuma transação pode vazar ou ser visualizada por outros lojistas cadastrados no banco.
            </p>
        </div>
    </div>

</div>
@endsection
