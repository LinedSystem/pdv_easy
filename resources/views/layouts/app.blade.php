<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PDV Easy')</title>
    
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

    @include('partials.sidebar')

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
                    @auth
                    <span class="text-sm font-bold font-display text-slate-900 bg-slate-100 px-3 py-1 rounded-lg">
                        {{ auth()->user()->tenant->nome_empresa }}
                    </span>
                    <span class="h-4 w-[1px] bg-slate-200 hidden sm:block"></span>
                    <span class="text-xs text-slate-400 font-medium hidden sm:block">CNPJ: {{ auth()->user()->tenant->cnpj }}</span>
                    @endauth
                </div>
            </div>

            <!-- Dados do Usuário e Logout -->
            <div class="flex items-center space-x-4">
                <!-- User Profile Info -->
                @auth
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-light">Administrador</p>
                    </div>
                    <div class="h-8 w-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 font-bold text-xs flex items-center justify-center shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>
                @endauth

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
            @yield('content')
        </main>
    </div>

</body>
</html>
