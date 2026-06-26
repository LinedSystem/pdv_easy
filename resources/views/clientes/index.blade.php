@extends('layouts.app')

@section('title', 'Clientes - PDV Easy')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Topbar Ações & Título -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Clientes (CRM)</h1>
            <p class="text-sm text-slate-500 font-light mt-1">Gerencie a carteira de clientes de sua empresa para vendas, crediário e controle de fidelidade.</p>
        </div>
        <div>
            <a href="{{ route('clientes.create') }}" 
               class="inline-flex items-center justify-center px-4.5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all cursor-pointer">
                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Cadastrar Cliente
            </a>
        </div>
    </div>

    <!-- Feedback Flash Messages -->
    @if (session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-3.5 shadow-sm">
            <div class="p-1.5 bg-emerald-600 text-white rounded-lg">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                </svg>
            </div>
            <span class="text-xs font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Barra de Filtros e Busca -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form action="{{ route('clientes.index') }}" method="GET" class="w-full md:max-w-md flex items-center gap-2">
            <div class="relative flex-1 rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nome, documento, e-mail..."
                    class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-xs">
            </div>
            @if ($search)
                <a href="{{ route('clientes.index') }}" class="px-3.5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all">
                    Limpar
                </a>
            @endif
            <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-sm">
                Filtrar
            </button>
        </form>

        <div class="text-[11px] text-slate-400 font-medium self-center">
            Total de registros: <span class="font-bold text-slate-700">{{ $clientes->total() }}</span>
        </div>
    </div>

    <!-- Tabela / Lista de Clientes -->
    @if ($clientes->count() > 0)
        <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Cliente</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Documento</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Contatos</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Localidade</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Consumidor</th>
                            <th scope="col" class="relative px-6 py-4.5">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($clientes as $cliente)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <!-- Coluna Cliente (Nome + Avatar + Tipo) -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3.5">
                                        <!-- Avatar Visual baseada nas Iniciais -->
                                        <div class="h-9 w-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 font-bold text-xs flex items-center justify-center shadow-sm">
                                            {{ strtoupper(substr($cliente->nome, 0, 2)) }}
                                        </div>
                                        <div class="overflow-hidden">
                                            <div class="text-xs font-bold text-slate-800 truncate" title="{{ $cliente->nome }}">{{ $cliente->nome }}</div>
                                            <div class="flex items-center space-x-1.5 mt-0.5">
                                                @if($cliente->tipo_cliente === 'PF')
                                                    <span class="text-[9px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-100/50 px-1.5 py-0.5 rounded-md uppercase">Física</span>
                                                @else
                                                    <span class="text-[9px] font-bold text-amber-700 bg-amber-50 border border-amber-100/50 px-1.5 py-0.5 rounded-md uppercase">Jurídica</span>
                                                @endif
                                                @if($cliente->apelido)
                                                    <span class="text-[10px] text-slate-400 truncate">({{ $cliente->apelido }})</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Coluna Documento (CPF / CNPJ) -->
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-700 font-semibold font-mono">
                                    {{ $cliente->documento }}
                                </td>

                                <!-- Coluna Contatos -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-slate-700 truncate" title="{{ $cliente->email }}">{{ $cliente->email }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">
                                        {{ $cliente->telefone_celular ?: ($cliente->telefone_fixo ?: 'Sem telefone') }}
                                    </div>
                                </td>

                                <!-- Coluna Localidade -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($cliente->cidade)
                                        <span class="text-xs text-slate-700 font-medium">{{ $cliente->cidade }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold bg-slate-100 border border-slate-200/40 px-1 py-0.5 rounded ml-1">{{ $cliente->uf }}</span>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Não informado</span>
                                    @endif
                                </td>

                                <!-- Coluna Consumidor Final -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($cliente->consumidor_final)
                                        <span class="inline-flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100/50 px-2 py-0.5 rounded-full">
                                            Sim
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-[10px] font-bold text-slate-500 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-full">
                                            Não
                                        </span>
                                    @endif
                                </td>

                                <!-- Coluna Ações -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex items-center justify-end space-x-1.5">
                                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50/50 rounded-lg transition-colors cursor-pointer" title="Editar">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente excluir este cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50/50 rounded-lg transition-colors cursor-pointer" title="Excluir">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            @if ($clientes->hasPages())
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                    {{ $clientes->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-12 text-center shadow-sm space-y-6 max-w-xl mx-auto my-8">
            <div class="mx-auto w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-inner">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            
            <div class="space-y-2">
                <h3 class="text-base font-bold text-slate-900">
                    @if ($search)
                        Nenhum cliente correspondente encontrado
                    @else
                        Nenhum cliente cadastrado ainda
                    @endif
                </h3>
                <p class="text-xs text-slate-500 font-light leading-relaxed max-w-md mx-auto">
                    @if ($search)
                        Sua busca por "<span class="font-semibold text-slate-800">{{ $search }}</span>" não retornou nenhum registro. Tente outros termos de busca.
                    @else
                        Cadastre seus clientes para gerenciar o CRM de fidelidade, limites de crediário e emitir relatórios de faturamento corporativo.
                    @endif
                </p>
            </div>

            <div class="flex items-center justify-center gap-3">
                @if ($search)
                    <a href="{{ route('clientes.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-semibold transition-all">
                        Limpar Busca
                    </a>
                @else
                    <a href="{{ route('clientes.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-100 transition-all">
                        Cadastrar Primeiro Cliente
                    </a>
                @endif
            </div>
        </div>
    @endif

</div>
@endsection
