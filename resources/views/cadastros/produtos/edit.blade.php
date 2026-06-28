@extends('layouts.app')

@section('title', 'Editar Produto - PDV Easy')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header da Página -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar Produto</h1>
            <p class="text-sm text-slate-500 font-light mt-1">Atualize as informações do produto, preços de venda, estoque e tributação fiscal.</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-3">
            <a href="{{ route('produtos.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold hover:bg-slate-50 transition-colors shadow-sm">
                Voltar à Lista
            </a>
        </div>
    </div>

    <!-- Mensagens de Erro Geral -->
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-2xl flex items-start space-x-3.5 shadow-sm">
            <div class="p-1.5 bg-rose-600 text-white rounded-lg flex-shrink-0">
                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-bold text-rose-950">Não foi possível salvar o produto:</h4>
                <p class="text-[11px] text-rose-700/80 leading-relaxed mt-0.5">Corrija os dados indicados abaixo e tente novamente.</p>
            </div>
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Bloco 1: Dados do Produto -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                    <svg class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Dados do Produto</span>
                </h3>
                      <!-- Layout Principal com Imagem no Canto Esquerdo (Estilo Foto de Perfil) e Campos ao Lado -->
            <div class="flex flex-col md:flex-row gap-6 items-start">
                
                <!-- Componente Upload de Imagem (Estilo Foto de Perfil Quadrada) -->
                <div class="flex-shrink-0 flex flex-col items-center md:items-start">
                    <span class="text-xs font-semibold text-slate-700 tracking-wide block mb-2">Imagem do Produto</span>
                    
                    <div id="image-drag-area" style="width: 240px; height: 240px;" class="bg-slate-50 border-2 border-dashed border-slate-200 hover:border-indigo-400 rounded-2xl flex flex-col items-center justify-center p-4 text-center cursor-pointer transition-all relative overflow-hidden group">
                        
                        <!-- Input File Oculto -->
                        <input type="file" name="imagem" id="imagem" class="hidden" accept="image/*">
                        
                        <!-- Conteúdo default do Drag Area -->
                        <div id="drag-placeholder" class="space-y-2 group-hover:scale-105 transition-transform duration-200 {{ $produto->imagem ? 'hidden' : '' }}">
                            <div class="h-12 w-12 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-2xl flex items-center justify-center mx-auto shadow-sm">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-indigo-600 block">Enviar imagem</span>
                                <span class="text-[10px] text-slate-400 block font-light">Arraste ou clique para selecionar</span>
                            </div>
                        </div>

                        <!-- Preview da Imagem Selecionada (ou imagem atual) -->
                        <img id="image-preview" src="{{ $produto->imagem ? asset($produto->imagem) : '#' }}" alt="Preview" class="absolute inset-0 w-full h-full object-cover {{ $produto->imagem ? '' : 'hidden' }}">
                        
                        <!-- Botão Remover Preview -->
                        <button type="button" id="remove-image-btn" class="absolute top-1.5 right-1.5 p-1 bg-slate-900/80 hover:bg-slate-900 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity z-10 {{ $produto->imagem ? '' : 'hidden' }}">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    @error('imagem')
                        <span class="text-[11px] font-semibold text-rose-600 block mt-1.5">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campos de Dados do Produto -->
                <div class="flex-1 w-full space-y-4.5">
                    
                    <!-- Linha 1: Nome do produto (70%), Código SKU (30%) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2 space-y-1.5">
                            <label for="nome" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Nome do Produto <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="nome" id="nome" required placeholder="Ex: Refrigerante Lata 350ml" value="{{ old('nome', $produto->nome) }}"
                                class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('nome') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('nome')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-1 space-y-1.5">
                            <label for="sku" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Código SKU
                            </label>
                            <input type="text" name="sku" id="sku" placeholder="Ex: REF-LATA-350" value="{{ old('sku', $produto->sku) }}"
                                class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('sku') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('sku')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Linha 2: Código de Barra/GTIN/EANTrib, Código de Barra Interno (*) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="barcode" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Código de Barra / GTIN / EAN
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <!-- Barcode scanner icon -->
                                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m0 11v3m8-7h-1m-11 0H5m16 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="barcode" id="barcode" placeholder="Ex: 7891234567890" value="{{ old('barcode', $produto->barcode) }}"
                                    class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('barcode') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            </div>
                            @error('barcode')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="barcode_interno" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Código de Barra Interno <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="barcode_interno" id="barcode_interno" required placeholder="Ex: 10002" value="{{ old('barcode_interno', $produto->barcode_interno) }}"
                                class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('barcode_interno') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('barcode_interno')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Linha 3: Unidade, Categoria Principal (*) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="unidade_id" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Unidade de Medida
                            </label>
                            <select name="unidade_id" id="unidade_id"
                                    class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('unidade_id') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                                <option value="">Selecione uma Unidade</option>
                                @foreach($unidades as $unidade)
                                    <option value="{{ $unidade->id }}" {{ old('unidade_id', $produto->unidade_id) == $unidade->id ? 'selected' : '' }}>
                                        {{ $unidade->nome }} ({{ $unidade->abreviacao }})
                                    </option>
                                @endforeach
                            </select>
                            @error('unidade_id')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="categoria_id" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Categoria Principal <span class="text-rose-500">*</span>
                            </label>
                            <select name="categoria_id" id="categoria_id" required
                                    class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('categoria_id') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                                <option value="">Selecione uma Categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $produto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Linha 4: Estoque Inicial, Estoque Mínimo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="estoque_inicial" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Estoque Inicial
                            </label>
                            <input type="number" step="0.001" name="estoque_inicial" id="estoque_inicial" placeholder="0,000" value="{{ old('estoque_inicial', $produto->estoque_inicial) }}"
                                class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('estoque_inicial') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('estoque_inicial')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="estoque_minimo" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Estoque Mínimo
                            </label>
                            <input type="number" step="0.001" name="estoque_minimo" id="estoque_minimo" placeholder="0,000" value="{{ old('estoque_minimo', $produto->estoque_minimo) }}"
                                class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('estoque_minimo') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('estoque_minimo')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Linha 5 (Financeiro): Preço de Custo, % Margem de Lucro (*), Preço de Venda -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50/50 p-4 border border-slate-100 rounded-2xl">
                        <div class="space-y-1.5">
                            <label for="preco_custo" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Preço de Custo (R$)
                            </label>
                            <input type="number" step="0.01" name="preco_custo" id="preco_custo" placeholder="0,00" value="{{ old('preco_custo', $produto->preco_custo) }}"
                                class="block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('preco_custo') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('preco_custo')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="margem_lucro" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                % Margem de Lucro <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="margem_lucro" id="margem_lucro" placeholder="0,00" value="{{ old('margem_lucro', $produto->margem_lucro) }}"
                                class="block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('margem_lucro') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('margem_lucro')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="preco_venda" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Preço de Venda (R$)
                            </label>
                            <input type="number" step="0.01" name="preco_venda" id="preco_venda" placeholder="0,00" value="{{ old('preco_venda', $produto->preco_venda) }}"
                                class="block w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('preco_venda') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                            @error('preco_venda')
                                <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bloco 2: Dados Fiscais -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
            <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                    <svg class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l2-2 4 4M9 4h.01M9 8h.01M9 12h.01M12 4h.01M12 8h.01M12 12h.01M15 4h.01M15 8h.01M15 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span>Dados Fiscais (Tributação)</span>
                </h3>
                <span class="text-[10px] text-indigo-600 bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-full font-bold uppercase">Fiscal</span>
            </div>

            <!-- Linha 1: Tributação, NCM (*) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="tributacao" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Tributação / Regime
                    </label>
                    <select name="tributacao" id="tributacao"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('tributacao') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        <option value="Simples Nacional" {{ old('tributacao', $produto->tributacao) === 'Simples Nacional' ? 'selected' : '' }}>Simples Nacional</option>
                        <option value="Regime Normal" {{ old('tributacao', $produto->tributacao) === 'Regime Normal' ? 'selected' : '' }}>Regime Normal (Lucro Presumido / Real)</option>
                        <option value="Substituição Tributária" {{ old('tributacao', $produto->tributacao) === 'Substituição Tributária' ? 'selected' : '' }}>Substituição Tributária (ST)</option>
                        <option value="Isento / Não Incide" {{ old('tributacao', $produto->tributacao) === 'Isento / Não Incide' ? 'selected' : '' }}>Isento / Não Incidência</option>
                    </select>
                    @error('tributacao')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="ncm" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Código NCM <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="ncm" id="ncm" required placeholder="Ex: 2202.10.00" value="{{ old('ncm', $produto->ncm) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('ncm') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('ncm')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Linha 2: CEST, Origem -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="cest" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Código CEST
                    </label>
                    <input type="text" name="cest" id="cest" placeholder="Ex: 03.007.00" value="{{ old('cest', $produto->cest) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('cest') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('cest')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="origem" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Origem da Mercadoria
                    </label>
                    <select name="origem" id="origem"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('origem') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        <option value="0" {{ old('origem', $produto->origem) === '0' ? 'selected' : '' }}>0 - Nacional</option>
                        <option value="1" {{ old('origem', $produto->origem) === '1' ? 'selected' : '' }}>1 - Estrangeira (Importação Direta)</option>
                        <option value="2" {{ old('origem', $produto->origem) === '2' ? 'selected' : '' }}>2 - Estrangeira (Adquirida no mercado interno)</option>
                        <option value="3" {{ old('origem', $produto->origem) === '3' ? 'selected' : '' }}>3 - Nacional (Mercadoria ou bem com Conteúdo de Importação > 40%)</option>
                        <option value="4" {{ old('origem', $produto->origem) === '4' ? 'selected' : '' }}>4 - Nacional (Produção conforme processos produtivos básicos)</option>
                        <option value="5" {{ old('origem', $produto->origem) === '5' ? 'selected' : '' }}>5 - Nacional (Conteúdo de Importação <= 40%)</option>
                        <option value="6" {{ old('origem', $produto->origem) === '6' ? 'selected' : '' }}>6 - Estrangeira (Importação Direta sem similar nacional)</option>
                        <option value="7" {{ old('origem', $produto->origem) === '7' ? 'selected' : '' }}>7 - Estrangeira (Adquirida internamente sem similar nacional)</option>
                    </select>
                    @error('origem')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Linha 3: Código de Benefício Fiscal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="cbenef" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Código de Benefício Fiscal (cBenef)
                    </label>
                    <input type="text" name="cbenef" id="cbenef" placeholder="Ex: PR800000" value="{{ old('cbenef', $produto->cbenef) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('cbenef') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('cbenef')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Botões de Ação ao Final -->
        <div class="flex items-center justify-end space-x-3.5 pt-4">
            <a href="{{ route('produtos.index') }}" 
               class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 rounded-xl text-xs font-bold transition-all shadow-sm">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-lg shadow-indigo-100 hover:shadow-xl transition-all cursor-pointer">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>

<!-- Scripts Vanilla JS para UX (Cálculo Financeiro e Upload de Imagem) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    // ----------------------------------------------------
    // 1. Upload de Imagem Drag & Drop com Preview
    // ----------------------------------------------------
    const dragArea = document.getElementById('image-drag-area');
    const imageInput = document.getElementById('imagem');
    const imagePreview = document.getElementById('image-preview');
    const dragPlaceholder = document.getElementById('drag-placeholder');
    const removeBtn = document.getElementById('remove-image-btn');

    // Clicar na área aciona o input file
    dragArea.addEventListener('click', function (e) {
        // Ignora cliques no botão de remover
        if (e.target.closest('#remove-image-btn')) return;
        imageInput.click();
    });

    // Efeitos visuais no drag & drop
    ['dragenter', 'dragover'].forEach(eventName => {
        dragArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dragArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        e.preventDefault();
        dragArea.classList.add('border-indigo-500', 'bg-indigo-50/30');
    }

    function unhighlight(e) {
        e.preventDefault();
        dragArea.classList.remove('border-indigo-500', 'bg-indigo-50/30');
    }

    // Soltar imagem na área
    dragArea.addEventListener('drop', function (e) {
        e.preventDefault();
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files && files.length > 0) {
            imageInput.files = files;
            handleFileSelection(files[0]);
        }
    });

    // Mudança no input file
    imageInput.addEventListener('change', function () {
        if (this.files && this.files.length > 0) {
            handleFileSelection(this.files[0]);
        }
    });

    function handleFileSelection(file) {
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecione apenas arquivos de imagem.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            dragPlaceholder.classList.add('hidden');
            removeBtn.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Botão remover imagem
    removeBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // Evita reabrir o seletor de arquivos
        imageInput.value = '';
        imagePreview.src = '#';
        imagePreview.classList.add('hidden');
        dragPlaceholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    });


    // ----------------------------------------------------
    // 2. Lógica Financeira: Margem de Lucro e Preço de Venda
    // ----------------------------------------------------
    const custoInput = document.getElementById('preco_custo');
    const margemInput = document.getElementById('margem_lucro');
    const vendaInput = document.getElementById('preco_venda');

    // Ao alterar o Custo ou a Margem, atualiza o Preço de Venda
    function calcularPrecoVenda() {
        const custo = parseFloat(custoInput.value) || 0;
        const margem = parseFloat(margemInput.value) || 0;
        
        // Venda = Custo * (1 + (Margem / 100))
        const venda = custo * (1 + (margem / 100));
        
        vendaInput.value = venda.toFixed(2);
    }

    // Ao alterar o Preço de Venda, atualiza a Margem de Lucro
    function calcularMargemLucro() {
        const custo = parseFloat(custoInput.value) || 0;
        const venda = parseFloat(vendaInput.value) || 0;

        if (custo > 0) {
            // Margem = ((Venda - Custo) / Custo) * 100
            const margem = ((venda - custo) / custo) * 100;
            margemInput.value = margem.toFixed(2);
        } else if (venda > 0) {
            margemInput.value = '100.00';
        }
    }

    custoInput.addEventListener('input', calcularPrecoVenda);
    margemInput.addEventListener('input', calcularPrecoVenda);
    vendaInput.addEventListener('input', calcularMargemLucro);
});
</script>
@endsection
