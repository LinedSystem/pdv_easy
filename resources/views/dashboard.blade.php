<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PDV Easy</title>
    
    <!-- Google Fonts: Inter and Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Laravel Vite Assets (includes Tailwind CSS v4) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, .font-display {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="h-full antialiased text-slate-800 flex overflow-hidden">

    <!-- Sidebar Lateral -->
    <aside class="hidden md:flex md:flex-col md:w-64 bg-slate-900 text-slate-400 flex-shrink-0 border-r border-slate-800">
        <!-- Header da Sidebar -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800/60">
            <div class="flex items-center space-x-2.5">
                <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center p-1.5 shadow-md">
                    <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-base font-bold font-display text-white tracking-tight">PDV<span class="text-indigo-400">Easy</span></span>
            </div>
        </div>

        <!-- Links de Navegação -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-indigo-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-900/30 transition-all">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-colors">
                <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span>Vendas / Caixa</span>
            </a>

            <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-colors">
                <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Estoque</span>
            </a>

            <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-colors">
                <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Relatórios</span>
            </a>

            <a href="#" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-xl text-sm font-medium transition-colors">
                <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
                <span>Configurações</span>
            </a>
        </nav>

        <!-- Footer da Sidebar (Licença) -->
        <div class="p-4 border-t border-slate-800/60 text-xs text-slate-600 font-light flex items-center justify-between">
            <span>Plano Corporativo</span>
            <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
        </div>
    </aside>

    <!-- Área Principal de Conteúdo -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-slate-200/80 px-6 flex items-center justify-between flex-shrink-0">
            <!-- Título e Nome da Empresa -->
            <div class="flex items-center space-x-4">
                <!-- Ícone Menu Mobile -->
                <button class="md:hidden text-slate-500 hover:text-slate-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex items-center space-x-2.5">
                    <span class="text-sm font-bold font-display text-slate-900 bg-slate-100 px-3 py-1 rounded-lg">
                        {{ auth()->user()->tenant->nome_empresa }}
                    </span>
                    <span class="h-4 w-[1px] bg-slate-200 hidden sm:block"></span>
                    <span class="text-xs text-slate-400 font-medium hidden sm:block">CNPJ: {{ auth()->user()->tenant->cnpj }}</span>
                </div>
            </div>

            <!-- Dados do Usuário e Logout -->
            <div class="flex items-center space-x-4">
                <!-- User Profile Info -->
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-light">Administrador</p>
                    </div>
                    <div class="h-8 w-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 font-bold text-xs flex items-center justify-center shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>

                <span class="h-6 w-[1px] bg-slate-200"></span>

                <!-- Form de Logout Seguro -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50/50 transition-colors duration-200 cursor-pointer">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-8V7a3 3 0 00-6 0v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
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
        </main>
    </div>

</body>
</html>
