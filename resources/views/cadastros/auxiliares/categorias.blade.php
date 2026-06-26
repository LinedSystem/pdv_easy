@extends('layouts.app')

@section('title', 'Categorias - PDV Easy')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header da Página -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Auxiliares: Categorias</h1>
            <p class="text-sm text-slate-500 font-light mt-1">Gerencie as categorias de produtos para organizar e classificar o seu catálogo de vendas.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openCreateModal()" 
                class="inline-flex items-center justify-center px-4.5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all cursor-pointer">
                <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Cadastrar Categoria
            </button>
        </div>
    </div>

    <!-- Mensagens de Feedback -->
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

    <!-- Tabela de Listagem em Largura Total -->
    <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between w-full">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-left">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th scope="col" class="px-6 py-4.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Nome da Categoria</th>
                        <th scope="col" class="relative px-6 py-4.5 text-right">
                            <span class="sr-only">Ações</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @if ($categorias->count() > 0)
                        @foreach ($categorias as $categoria)
                            <tr class="hover:bg-slate-50/50 transition-colors {{ $editCategoria && $editCategoria->id === $categoria->id ? 'bg-indigo-50/20' : '' }}">
                                <!-- Coluna Nome -->
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-semibold text-slate-800">
                                    {{ $categoria->nome }}
                                </td>

                                <!-- Coluna Ações -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Editar (Azul) -->
                                        <button onclick="openEditModal('{{ $categoria->id }}', '{{ addslashes($categoria->nome) }}')" 
                                            class="p-1.5 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer" 
                                            title="Editar Categoria">
                                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <!-- Excluir (Vermelho) -->
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente excluir esta categoria?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" 
                                                title="Excluir Categoria">
                                                <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center">
                                <div class="mx-auto w-12 h-12 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center mb-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h4 class="text-xs font-bold text-slate-800">Nenhuma categoria cadastrada ainda</h4>
                                <p class="text-[10px] text-slate-400 mt-1 font-light">Clique no botão acima para cadastrar a primeira categoria.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Paginação -->
        @if ($categorias->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                {{ $categorias->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal de Cadastro / Edição -->
<div id="category-modal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none select-none">
    <!-- Backdrop Overlay -->
    <div class="fixed inset-0 transition-opacity" style="background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px);" onclick="closeModal()"></div>
    
    <!-- Modal Card Container -->
    <div class="relative w-full max-w-md mx-auto my-6 z-50 px-4">
        <div class="relative flex flex-col w-full bg-white border border-slate-200/80 rounded-2xl shadow-2xl outline-none focus:outline-none">
            
            <!-- Header -->
            <div class="flex items-center justify-between p-6 sm:px-7 border-b border-slate-100">
                <h3 id="modal-title" class="text-sm font-bold text-slate-900 flex items-center space-x-2">
                    <svg class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Cadastrar Categoria</span>
                </h3>
                <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600 rounded-lg p-1 transition-colors cursor-pointer">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="category-form" action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="p-6 sm:p-8 space-y-6">
                    <!-- Inline warning on error -->
                    @if ($errors->any())
                        <div class="p-4 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl flex items-start space-x-2.5">
                            <svg class="h-4 w-4 mt-0.5 text-rose-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-[10px] font-semibold leading-relaxed block">Erro: Categoria não pôde ser salva. Verifique abaixo.</span>
                        </div>
                    @endif

                    <!-- Input: Nome da Categoria -->
                    <div class="space-y-2">
                        <label for="nome" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Nome da Categoria <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nome" id="nome" required placeholder="Ex: Bebidas, Mercearia..." 
                            value="{{ old('nome') }}"
                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm @error('nome') border-rose-400 focus:ring-rose-500/20 focus:border-rose-500 @enderror">
                        @error('nome')
                            <span id="error-nome" class="text-xs font-semibold text-rose-600 block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end gap-3 p-6 border-t border-slate-100 bg-slate-50/50 rounded-b-2xl">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-xl text-xs font-semibold tracking-wide transition-all shadow-sm cursor-pointer">
                        Cancelar
                    </button>
                    <button type="submit" id="submit-btn" 
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold tracking-wide shadow-md shadow-indigo-100 hover:shadow-lg hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                        Salvar Categoria
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Control Scripts -->
<script>
    function openCreateModal() {
        const form = document.getElementById('category-form');
        form.action = "{{ route('categorias.store') }}";
        
        // Remove PUT method if exists
        const methodInput = document.getElementById('form-method');
        if (methodInput) {
            methodInput.remove();
        }
        
        document.getElementById('nome').value = '';
        document.getElementById('modal-title').querySelector('span').innerText = 'Cadastrar Categoria';
        document.getElementById('submit-btn').innerText = 'Salvar Categoria';
        
        // Show Modal
        const modal = document.getElementById('category-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => document.getElementById('nome').focus(), 150);
    }

    function openEditModal(id, nome) {
        const form = document.getElementById('category-form');
        form.action = `/categorias/${id}`;
        
        // Add or update PUT method input
        let methodInput = document.getElementById('form-method');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            methodInput.id = 'form-method';
            form.appendChild(methodInput);
        } else {
            methodInput.value = 'PUT';
        }
        
        document.getElementById('nome').value = nome;
        document.getElementById('modal-title').querySelector('span').innerText = 'Editar Categoria';
        document.getElementById('submit-btn').innerText = 'Atualizar Categoria';
        
        // Show Modal
        const modal = document.getElementById('category-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => document.getElementById('nome').focus(), 150);
    }

    function closeModal() {
        const modal = document.getElementById('category-modal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        
        // Remove validation error span if user cancels
        const errorSpan = document.getElementById('error-nome');
        if (errorSpan) {
            errorSpan.remove();
        }
    }

    // Auto-reopen the modal on validation errors
    document.addEventListener("DOMContentLoaded", function() {
        @if ($errors->any())
            @if ($editCategoria)
                openEditModal("{{ $editCategoria->id }}", "{{ old('nome', $editCategoria->nome) }}");
            @else
                openCreateModal();
                // Set prepopulated error values
                document.getElementById('nome').value = "{{ old('nome') }}";
            @endif
        @elseif ($editCategoria)
            openEditModal("{{ $editCategoria->id }}", "{{ $editCategoria->nome }}");
        @endif
    });
</script>
@endsection
