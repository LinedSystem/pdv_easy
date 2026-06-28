@extends('layouts.app')

@section('title', 'Produtos - PDV Easy')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Topbar Ações & Título -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Produtos</h1>
            <p class="text-sm text-slate-500 font-light mt-1">Gerencie o catálogo de produtos, controle de estoque, preços e dados fiscais de sua empresa.</p>
        </div>
        <div>
            <a href="{{ route('produtos.create') }}" 
               class="inline-flex items-center justify-center px-4.5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all cursor-pointer">
                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Cadastrar Produto
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
        <form action="{{ route('produtos.index') }}" method="GET" class="w-full md:max-w-md flex items-center gap-2">
            <div class="relative flex-1 rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nome, SKU, código de barras..."
                    class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-xs">
            </div>
            @if ($search)
                <a href="{{ route('produtos.index') }}" class="px-3.5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all">
                    Limpar
                </a>
            @endif
            <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all shadow-sm">
                Filtrar
            </button>
        </form>

        <div class="text-[11px] text-slate-400 font-medium self-center">
            Total de registros: <span class="font-bold text-slate-700">{{ $produtos->total() }}</span>
        </div>
    </div>

    <!-- Tabela / Lista de Produtos -->
    @if ($produtos->count() > 0)
        <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider w-16">Imagem</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Produto</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">SKU</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Preço Venda</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Estoque</th>
                            <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Categoria</th>
                            <th scope="col" class="relative px-6 py-4.5">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($produtos as $produto)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <!-- Coluna Imagem -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($produto->imagem)
                                        <img src="{{ asset($produto->imagem) }}" alt="{{ $produto->nome }}" class="h-10 w-10 object-cover rounded-xl border border-slate-100 shadow-sm">
                                    @else
                                        <div class="h-10 w-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 shadow-sm">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                <!-- Coluna Produto -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="overflow-hidden">
                                        <div class="text-xs font-bold text-slate-800 truncate" title="{{ $produto->nome }}">{{ $produto->nome }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5 font-mono">EAN: {{ $produto->barcode ?: 'Sem código' }}</div>
                                    </div>
                                </td>

                                <!-- Coluna SKU -->
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-mono">
                                    {{ $produto->sku ?: '-' }}
                                </td>

                                <!-- Coluna Preço Venda -->
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-800">
                                    R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                </td>

                                <!-- Coluna Estoque -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold {{ $produto->estoque_atual <= $produto->estoque_minimo ? 'text-rose-600' : 'text-slate-700' }}">
                                            {{ $produto->estoque_atual == intval($produto->estoque_atual) ? number_format($produto->estoque_atual, 0) : number_format($produto->estoque_atual, 3, ',', '.') }}
                                            <span class="text-[10px] font-normal text-slate-400 font-sans">
                                                {{ $produto->unidade ? $produto->unidade->abreviacao : 'UN' }}
                                            </span>
                                        </span>
                                        @if($produto->estoque_atual <= $produto->estoque_minimo)
                                            <span class="text-[9px] font-semibold text-rose-500 bg-rose-50 border border-rose-100/50 px-1 py-0.5 rounded w-fit mt-0.5 uppercase tracking-wide">Estoque Baixo</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Coluna Categoria -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-[10px] font-bold text-indigo-700 bg-indigo-50 border border-indigo-100/50 px-2 py-0.5 rounded-full uppercase">
                                        {{ $produto->categoria ? $produto->categoria->nome : 'Geral' }}
                                    </span>
                                </td>

                                <!-- Coluna Ações -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex items-center justify-end space-x-2.5">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" 
                                           class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50/50 rounded-lg transition-colors cursor-pointer"
                                           title="Editar Produto">
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>

                                        <!-- Botão Deletar com Form -->
                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" 
                                              onsubmit="return confirm('Deseja realmente excluir este produto? Esta ação não pode ser desfeita.')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50/50 rounded-lg transition-colors cursor-pointer"
                                                    title="Excluir Produto">
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            @if ($produtos->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $produtos->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-12 text-center shadow-sm">
            <div class="h-16 w-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 mx-auto mb-4 shadow-inner">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h3 class="text-sm font-bold text-slate-900">Nenhum produto cadastrado ainda</h3>
            <p class="text-xs text-slate-500 font-light mt-1 max-w-xs mx-auto">Adicione produtos ao seu estoque para realizar vendas e gerenciar o faturamento fiscal da sua empresa.</p>
            <div class="mt-5">
                <a href="{{ route('produtos.create') }}" 
                   class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-indigo-100 transition-all cursor-pointer">
                    Cadastrar Primeiro Produto
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
