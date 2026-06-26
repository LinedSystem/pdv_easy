@extends('layouts.app')

@section('title', 'Editar Fornecedor - PDV Easy')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header da Página -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar Fornecedor</h1>
            <p class="text-sm text-slate-500 font-light mt-1">Atualize as informações do fornecedor para compras, controle de estoque e entrada de mercadorias.</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-3">
            <a href="{{ route('fornecedores.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold hover:bg-slate-50 transition-colors shadow-sm">
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
                <h4 class="text-xs font-bold text-rose-950">Não foi possível atualizar o fornecedor:</h4>
                <p class="text-[11px] text-rose-700/80 leading-relaxed mt-0.5">Corrija os dados indicados abaixo e tente novamente.</p>
            </div>
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Seleção de Tipo de Fornecedor (Card de Destaque) -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Tipo de Personalidade</h2>
                    <p class="text-xs text-slate-500 font-light mt-0.5">Selecione se o fornecedor é Pessoa Física ou Pessoa Jurídica para adaptar os campos do formulário.</p>
                </div>
                <div class="flex items-center bg-slate-100 p-1 rounded-xl w-fit border border-slate-200/40">
                    <label class="relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-bold cursor-pointer transition-all duration-200 select-none" id="label-pf">
                        <input type="radio" name="tipo_fornecedor" value="PF" class="sr-only" 
                            {{ old('tipo_fornecedor', $fornecedor->tipo_fornecedor) === 'PF' ? 'checked' : '' }} onchange="toggleSupplierType('PF')">
                        <span class="z-10 text-indigo-600 font-bold" id="text-pf">Pessoa Física</span>
                        <div class="absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all" id="bg-pf"></div>
                    </label>
                    <label class="relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-medium text-slate-600 cursor-pointer transition-all duration-200 select-none" id="label-pj">
                        <input type="radio" name="tipo_fornecedor" value="PJ" class="sr-only" 
                            {{ old('tipo_fornecedor', $fornecedor->tipo_fornecedor) === 'PJ' ? 'checked' : '' }} onchange="toggleSupplierType('PJ')">
                        <span class="z-10" id="text-pj">Pessoa Jurídica</span>
                        <div class="absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all opacity-0" id="bg-pj"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Seções em Grid de Duas Colunas (Responsivo) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Card 1: Informações Básicas -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                        <svg class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Seção 1: Informações Básicas</span>
                    </h3>
                    <span class="text-[10px] text-indigo-600 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-full font-bold uppercase">Cadastral</span>
                </div>

                <!-- Input: CPF / CNPJ -->
                <div class="space-y-1.5">
                    <label for="documento" id="lbl-documento" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        CPF <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="documento" id="documento" required placeholder="000.000.000-00" value="{{ old('documento', $fornecedor->documento) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('documento') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('documento')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input: Nome / Razão Social -->
                <div class="space-y-1.5">
                    <label for="nome" id="lbl-nome" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Nome Completo <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="nome" id="nome" required placeholder="Digite o nome completo" value="{{ old('nome', $fornecedor->nome) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('nome') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('nome')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input: Apelido / Nome Fantasia -->
                <div class="space-y-1.5">
                    <label for="apelido" id="lbl-apelido" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        Apelido
                    </label>
                    <input type="text" name="apelido" id="apelido" placeholder="Apelido ou nome social" value="{{ old('apelido', $fornecedor->apelido) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('apelido') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('apelido')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input: RG / Inscrição Estadual -->
                <div class="space-y-1.5">
                    <label for="registro_geral" id="lbl-registro_geral" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        RG
                    </label>
                    <input type="text" name="registro_geral" id="registro_geral" placeholder="Número do RG" value="{{ old('registro_geral', $fornecedor->registro_geral) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('registro_geral') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('registro_geral')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Grid de Contribuinte & Status Ativo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
                    <!-- Tipo de Contribuinte -->
                    <div class="space-y-1.5">
                        <label for="tipo_contribuinte" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Tipo de Contribuinte
                        </label>
                        <select name="tipo_contribuinte" id="tipo_contribuinte"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                            <option value="não_contribuinte" {{ old('tipo_contribuinte', $fornecedor->tipo_contribuinte) === 'não_contribuinte' ? 'selected' : '' }}>Não Contribuinte</option>
                            <option value="contribuinte_icms" {{ old('tipo_contribuinte', $fornecedor->tipo_contribuinte) === 'contribuinte_icms' ? 'selected' : '' }}>Contribuinte ICMS</option>
                            <option value="isento" {{ old('tipo_contribuinte', $fornecedor->tipo_contribuinte) === 'isento' ? 'selected' : '' }}>Isento</option>
                        </select>
                    </div>

                    <!-- Status Ativo Checkbox Toggle -->
                    <div class="space-y-1.5 flex flex-col justify-end">
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-slate-200 rounded-xl transition-all hover:bg-slate-100/50">
                            <div>
                                <span class="text-xs font-bold text-slate-700 block select-none">Fornecedor Ativo</span>
                                <span class="text-[9px] text-slate-400 block select-none">Permitir movimentações</span>
                            </div>
                            <label class="inline-flex relative items-center cursor-pointer select-none">
                                <input type="checkbox" name="ativo" id="ativo" class="sr-only peer"
                                    {{ old('ativo', $fornecedor->ativo ? 'on' : 'off') === 'on' ? 'checked' : '' }}>
                                <div class="w-9 h-5 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Telefones Lado a Lado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="telefone_fixo" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Telefone Fixo
                        </label>
                        <input type="text" name="telefone_fixo" id="telefone_fixo" placeholder="(00) 0000-0000" value="{{ old('telefone_fixo', $fornecedor->telefone_fixo) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('telefone_fixo') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('telefone_fixo')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label for="telefone_celular" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Celular
                        </label>
                        <input type="text" name="telefone_celular" id="telefone_celular" placeholder="(00) 00000-0000" value="{{ old('telefone_celular', $fornecedor->telefone_celular) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('telefone_celular') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('telefone_celular')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Input: Email -->
                <div class="space-y-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        E-mail <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" required placeholder="exemplo@dominio.com" value="{{ old('email', $fornecedor->email) }}"
                        class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('email') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                    @error('email')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Card 2: Endereço -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm space-y-5">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                        <svg class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Seção 2: Localização e Endereço</span>
                    </h3>
                    <span class="text-[10px] text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-full font-bold uppercase">Logística</span>
                </div>

                <!-- CEP com Botão Buscar -->
                <div class="space-y-1.5">
                    <label for="cep" class="text-xs font-semibold text-slate-700 tracking-wide block">
                        CEP <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <input type="text" name="cep" id="cep" required placeholder="00000-000" maxlength="9" value="{{ old('cep', $fornecedor->cep) }}"
                            class="block flex-1 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('cep') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        <button type="button" onclick="buscarCep()"
                            class="px-4 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 border border-indigo-200/50 hover:border-indigo-300 rounded-xl text-xs font-bold transition-all flex items-center justify-center space-x-1.5 shadow-sm hover:shadow-md cursor-pointer self-stretch h-fit">
                            <svg class="h-3.5 w-3.5 animate-bounce-custom" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span>Buscar CEP</span>
                        </button>
                    </div>
                    @error('cep')
                        <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logradouro e Número Lado a Lado -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-3 space-y-1.5">
                        <label for="logradouro" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Logradouro <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="logradouro" id="logradouro" required placeholder="Ex: Rua, Avenida, etc" value="{{ old('logradouro', $fornecedor->logradouro) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('logradouro') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('logradouro')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-1 space-y-1.5">
                        <label for="numero" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Número <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="numero" id="numero" required placeholder="Nº" value="{{ old('numero', $fornecedor->numero) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('numero') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('numero')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Bairro e Complemento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="bairro" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Bairro
                        </label>
                        <input type="text" name="bairro" id="bairro" placeholder="Digite o Bairro" value="{{ old('bairro', $fornecedor->bairro) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('bairro') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('bairro')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1.5">
                        <label for="complemento" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Complemento
                        </label>
                        <input type="text" name="complemento" id="complemento" placeholder="Apt, Bloco, etc" value="{{ old('complemento', $fornecedor->complemento) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('complemento') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('complemento')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Cidade, UF e Código IBGE Lado a Lado -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1.5 space-y-1.5">
                        <label for="cidade" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Cidade
                        </label>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" value="{{ old('cidade', $fornecedor->cidade) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('cidade') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('cidade')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-0.5 space-y-1.5">
                        <label for="uf" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            UF
                        </label>
                        <input type="text" name="uf" id="uf" placeholder="UF" maxlength="2" value="{{ old('uf', $fornecedor->uf) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('uf') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('uf')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1 space-y-1.5">
                        <label for="ibge" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            IBGE
                        </label>
                        <input type="text" name="ibge" id="ibge" placeholder="Cód. IBGE" value="{{ old('ibge', $fornecedor->ibge) }}"
                            class="block w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('ibge') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('ibge')
                            <span class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <!-- Botões de Ação (Alinhamento à Direita) -->
        <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-200">
            <a href="{{ route('fornecedores.index') }}"
                class="px-5 py-2.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold tracking-wide transition-all shadow-sm">
                Cancelar
            </a>
            <button type="submit"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold tracking-wide shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>

<!-- Scripts de Interação Dinâmica -->
<script>
    // Executa no carregamento da página para restaurar o estado selecionado (PF ou PJ) pós-erro de validação
    document.addEventListener("DOMContentLoaded", function() {
        const selectedType = "{{ old('tipo_fornecedor', $fornecedor->tipo_fornecedor) }}";
        toggleSupplierType(selectedType);
    });

    // Alterna o Tipo de Fornecedor (Pessoa Física / Pessoa Jurídica)
    function toggleSupplierType(type) {
        const labelPF = document.getElementById('label-pf');
        const labelPJ = document.getElementById('label-pj');
        const textPF = document.getElementById('text-pf');
        const textPJ = document.getElementById('text-pj');
        const bgPF = document.getElementById('bg-pf');
        const bgPJ = document.getElementById('bg-pj');

        const lblDocumento = document.getElementById('lbl-documento');
        const lblNome = document.getElementById('lbl-nome');
        const lblApelido = document.getElementById('lbl-apelido');
        const lblRegistroGeral = document.getElementById('lbl-registro_geral');

        const inputDocumento = document.getElementById('documento');
        const inputNome = document.getElementById('nome');
        const inputApelido = document.getElementById('apelido');
        const inputRegistroGeral = document.getElementById('registro_geral');

        if (type === 'PF') {
            // Estilização do Switch
            labelPF.className = "relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-bold cursor-pointer transition-all duration-200 select-none";
            textPF.className = "z-10 text-indigo-600 font-bold";
            bgPF.className = "absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all opacity-100";

            labelPJ.className = "relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-medium text-slate-600 cursor-pointer transition-all duration-200 select-none";
            textPJ.className = "z-10";
            bgPJ.className = "absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all opacity-0";

            // Modificação dos Labels e Placeholders para Pessoa Física
            lblDocumento.innerHTML = 'CPF <span class="text-rose-500">*</span>';
            inputDocumento.placeholder = '000.000.000-00';
            
            lblNome.innerHTML = 'Nome Completo <span class="text-rose-500">*</span>';
            inputNome.placeholder = 'Digite o nome completo';

            lblApelido.innerText = 'Apelido';
            inputApelido.placeholder = 'Apelido ou nome social';

            lblRegistroGeral.innerText = 'RG';
            inputRegistroGeral.placeholder = 'Número do RG';
        } else {
            // Estilização do Switch
            labelPJ.className = "relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-bold cursor-pointer transition-all duration-200 select-none";
            textPJ.className = "z-10 text-indigo-600 font-bold";
            bgPJ.className = "absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all opacity-100";

            labelPF.className = "relative flex items-center justify-center px-4 py-2 rounded-lg text-xs font-medium text-slate-600 cursor-pointer transition-all duration-200 select-none";
            textPF.className = "z-10";
            bgPF.className = "absolute inset-0 bg-white rounded-lg shadow-sm border border-slate-200/40 transition-all opacity-0";

            // Modificação dos Labels e Placeholders para Pessoa Jurídica
            lblDocumento.innerHTML = 'CNPJ <span class="text-rose-500">*</span>';
            inputDocumento.placeholder = '00.000.000/0000-00';

            lblNome.innerHTML = 'Razão Social <span class="text-rose-500">*</span>';
            inputNome.placeholder = 'Digite a razão social da empresa';

            lblApelido.innerText = 'Nome Fantasia';
            inputApelido.placeholder = 'Digite o nome fantasia';

            lblRegistroGeral.innerText = 'Inscrição Estadual';
            inputRegistroGeral.placeholder = 'Número da Inscrição Estadual';
        }
    }

    // Máscara dinâmica para Documento (CPF / CNPJ)
    const docInput = document.getElementById('documento');
    docInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        const isPJ = document.querySelector('input[name="tipo_fornecedor"]:checked').value === 'PJ';

        if (isPJ) {
            if (value.length > 14) value = value.slice(0, 14);
            if (value.length > 12) {
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})$/, "$1.$2.$3/$4-$5");
            } else if (value.length > 8) {
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})$/, "$1.$2.$3/$4");
            } else if (value.length > 5) {
                value = value.replace(/^(\d{2})(\d{3})(\d{1,3})$/, "$1.$2.$3");
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{1,3})$/, "$1.$2");
            }
        } else {
            if (value.length > 11) value = value.slice(0, 11);
            if (value.length > 9) {
                value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{1,2})$/, "$1.$2.$3-$4");
            } else if (value.length > 6) {
                value = value.replace(/^(\d{3})(\d{3})(\d{1,3})$/, "$1.$2.$3");
            } else if (value.length > 3) {
                value = value.replace(/^(\d{3})(\d{1,3})$/, "$1.$2");
            }
        }
        e.target.value = value;
    });

    // Máscara para CEP (00000-000)
    const cepInput = document.getElementById('cep');
    cepInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        if (value.length > 5) {
            value = value.replace(/^(\d{5})(\d{1,3})$/, "$1-$2");
        }
        e.target.value = value;
    });

    // Máscara para Telefones
    const fixoInput = document.getElementById('telefone_fixo');
    fixoInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 10) value = value.slice(0, 10);
        if (value.length > 6) {
            value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, "($1) $2-$3");
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{1,4})$/, "($1) $2");
        }
        e.target.value = value;
    });

    const celularInput = document.getElementById('telefone_celular');
    celularInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        if (value.length > 7) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{1,5})$/, "($1) $2");
        }
        e.target.value = value;
    });

    // API ViaCEP para Autopreenchimento de Endereço
    function buscarCep() {
        const cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep.length !== 8) {
            alert('Por favor, informe um CEP válido com 8 dígitos.');
            return;
        }

        const btn = document.querySelector('button[onclick="buscarCep()"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = `<span class="animate-spin inline-block w-3 h-3 border-2 border-current border-t-transparent rounded-full mr-1.5"></span> Buscando...`;
        btn.disabled = true;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(data => {
                if (data.erro) {
                    alert('CEP não encontrado no banco nacional.');
                } else {
                    document.getElementById('logradouro').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';
                    document.getElementById('uf').value = data.uf || '';
                    document.getElementById('ibge').value = data.ibge || '';
                    document.getElementById('numero').focus();
                }
            })
            .catch(() => alert('Erro na conexão. Verifique sua internet.'))
            .finally(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }
</script>
@endsection
