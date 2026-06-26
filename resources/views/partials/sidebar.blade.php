<!-- Sidebar Lateral -->
<aside class="hidden md:flex md:flex-col md:w-64 bg-slate-900 text-slate-400 flex-shrink-0 border-r border-slate-800 h-screen select-none">
    
    <!-- Header da Sidebar -->
    <div class="px-6 py-5 border-b border-slate-800/60 space-y-2.5">
        <div class="flex items-center space-x-2.5">
            <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center p-1.5 shadow-lg shadow-indigo-950/50 flex-shrink-0">
                <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-base font-bold font-display text-white tracking-tight">PDV<span class="text-indigo-400">Easy</span></span>
        </div>
        
        @auth
        <div class="flex items-center space-x-2 bg-slate-950/40 rounded-lg px-2.5 py-1.5 border border-slate-800/50">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider truncate" title="{{ auth()->user()->tenant->nome_empresa }}">
                {{ auth()->user()->tenant->nome_empresa }}
            </span>
        </div>
        @endauth
    </div>

    <!-- Links de Navegação -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto custom-scrollbar">
        
        <!-- Item: Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'hover:bg-slate-800/50 hover:text-white' }}">
            <div class="flex items-center space-x-3">
                <svg class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                </svg>
                <span>Dashboard</span>
            </div>
            @if(request()->routeIs('dashboard'))
            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
            @endif
        </a>

        <!-- Item: Vendas (Frente de Caixa) -->
        <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-colors group">
            <svg class="h-5 w-5 text-slate-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <span>Vendas (PDV)</span>
        </a>

        <!-- Módulo: Cadastros com Submenu -->
        <details class="group select-none" open>
            <summary class="flex items-center justify-between px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                <div class="flex items-center space-x-3">
                    <svg class="h-5 w-5 text-slate-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Cadastros</span>
                </div>
                <!-- Chevron indicator icon -->
                <svg class="h-4 w-4 text-slate-500 group-open:rotate-180 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            
            <!-- Submenu Items -->
            <div class="mt-1.5 pl-4 ml-6 border-l border-slate-800 space-y-1">
                
                <!-- Subitem: Clientes -->
                <a href="{{ route('clientes.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors group {{ request()->routeIs('clientes.index') || request()->routeIs('clientes.create') ? 'text-white bg-slate-800/60 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                    <svg class="h-4 w-4 transition-colors {{ request()->routeIs('clientes.index') || request()->routeIs('clientes.create') ? 'text-indigo-400' : 'text-slate-600 group-hover:text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Clientes (CRM)</span>
                </a>

                <!-- Subitem: Fornecedores -->
                <a href="{{ route('fornecedores.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-xs font-medium transition-colors group {{ request()->routeIs('fornecedores.index') || request()->routeIs('fornecedores.create') ? 'text-white bg-slate-800/60 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                    <svg class="h-4 w-4 transition-colors {{ request()->routeIs('fornecedores.index') || request()->routeIs('fornecedores.create') ? 'text-indigo-400' : 'text-slate-600 group-hover:text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V14a1 1 0 01-1 1H17" />
                    </svg>
                    <span>Fornecedores</span>
                </a>

                <!-- Subitem: Auxiliares (Menu colapsável) -->
                <details class="group/aux select-none" {{ request()->routeIs('categorias.*') || request()->routeIs('unidades.*') ? 'open' : '' }}>
                    <summary class="flex items-center justify-between px-3 py-2 hover:bg-slate-800/40 hover:text-white rounded-lg text-xs font-medium transition-all cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <div class="flex items-center space-x-3">
                            <svg class="h-4 w-4 transition-colors {{ request()->routeIs('categorias.*') || request()->routeIs('unidades.*') ? 'text-indigo-400' : 'text-slate-600 group-hover:text-indigo-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <span class="{{ request()->routeIs('categorias.*') || request()->routeIs('unidades.*') ? 'text-white font-semibold' : 'text-slate-400' }}">Auxiliares</span>
                        </div>
                        <!-- Chevron indicator icon -->
                        <svg class="h-3 w-3 text-slate-500 group-open/aux:rotate-180 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </summary>

                    <!-- Submenu items for Auxiliares with custom indentation -->
                    <div class="mt-1 pl-4 ml-4 border-l border-slate-800 space-y-1">
                        <!-- Subitem: Categorias -->
                        <a href="{{ route('categorias.index') }}" class="flex items-center space-x-2 px-3 py-1.5 rounded-md text-[11px] font-medium transition-colors group/sub {{ request()->routeIs('categorias.index') ? 'text-white bg-slate-800/60 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('categorias.index') ? 'bg-indigo-400' : 'bg-slate-600 group-hover/sub:bg-indigo-400' }} transition-colors"></span>
                            <span>Categorias</span>
                        </a>

                        <!-- Subitem: Unidades -->
                        <a href="{{ route('unidades.index') }}" class="flex items-center space-x-2 px-3 py-1.5 rounded-md text-[11px] font-medium transition-colors group/sub {{ request()->routeIs('unidades.index') ? 'text-white bg-slate-800/60 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('unidades.index') ? 'bg-indigo-400' : 'bg-slate-600 group-hover/sub:bg-indigo-400' }} transition-colors"></span>
                            <span>Unidades</span>
                        </a>
                    </div>
                </details>

                <!-- Subitem: Produto -->
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/40 transition-colors group">
                    <svg class="h-4 w-4 text-slate-600 group-hover:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Produtos</span>
                </a>

                <!-- Subitem: Crédito -->
                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800/40 transition-colors group">
                    <svg class="h-4 w-4 text-slate-600 group-hover:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span>Crédito (Crediário)</span>
                </a>

            </div>
        </details>
        
    </nav>

    <!-- Footer da Sidebar (Usuário Logado e Ações) -->
    <div class="p-4 border-t border-slate-800/60 bg-slate-950/20">
        @auth
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 overflow-hidden">
                <!-- Avatar do Usuário -->
                <div class="h-9 w-9 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-inner">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <!-- Nome / Cargo -->
                <div class="truncate">
                    <p class="text-xs font-bold text-slate-200 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-slate-500 font-light truncate">Administrador</p>
                </div>
            </div>

            <!-- Botão de Sair (Logout) -->
            <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                @csrf
                <button type="submit" title="Sair do Sistema" class="p-2 rounded-lg text-slate-500 hover:text-red-400 hover:bg-red-950/20 transition-all cursor-pointer">
                    <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-8V7a3 3 0 00-6 0v1" />
                    </svg>
                </button>
            </form>
        </div>
        @endauth
    </div>
</aside>
