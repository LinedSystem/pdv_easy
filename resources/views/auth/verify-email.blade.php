<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar E-mail - PDV Easy</title>
    
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
<body class="h-full antialiased text-slate-800 flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-3xl border border-slate-200/70 shadow-2xl p-8 sm:p-10 space-y-8 relative overflow-hidden">
        
        <!-- Detalhe decorativo superior -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>

        <!-- Ícone do Email -->
        <div class="mx-auto w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-2.25-1.5a2 2 0 00-2.22 0l-2.25 1.5" />
            </svg>
        </div>

        <!-- Textos Principais -->
        <div class="text-center space-y-3">
            <h2 class="text-2xl font-bold font-display text-slate-900 tracking-tight">
                Confirme seu e-mail corporativo
            </h2>
            <p class="text-sm text-slate-500 font-light leading-relaxed">
                Para garantir a segurança do seu caixa corporativo, enviamos um link de validação para o e-mail de cadastro. Por favor, clique no link para ativar seu acesso.
            </p>
        </div>

        <!-- Banner de Sucesso pós reenvio -->
        @if (session('message'))
            <div class="text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 rounded-xl p-3 text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- Formulários de Ação -->
        <div class="space-y-4">
            <!-- Reenvio -->
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold tracking-wide shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-200 cursor-pointer">
                    Reenviar E-mail de Confirmação
                    <svg class="ml-2 -mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 7.89M9 11l3 3L22 4" />
                    </svg>
                </button>
            </form>

            <!-- Logout / Sair -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-center text-xs text-slate-400 hover:text-indigo-600 font-semibold transition-colors duration-150 py-2 cursor-pointer">
                    Voltar para o Login
                </button>
            </form>
        </div>

    </div>

</body>
</html>
