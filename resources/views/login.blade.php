<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - PDV Easy</title>
    
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
<body class="h-full antialiased text-slate-800">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12 overflow-hidden">
        
        <!-- Coluna da Esquerda: Painel Visual (Oculto em Mobile) -->
        <div class="hidden lg:flex lg:col-span-6 relative bg-gradient-to-tr from-indigo-900 to-indigo-700 flex-col justify-between p-12 overflow-hidden">
            <!-- Efeitos decorativos de fundo -->
            <div class="absolute inset-0 pointer-events-none opacity-20">
                <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-indigo-500 filter blur-3xl"></div>
                <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-blue-400 filter blur-3xl"></div>
                <!-- Padrão geométrico suave -->
                <svg class="absolute inset-0 w-full h-full text-white/5" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect width="20" height="20" fill="none" stroke="currentColor" stroke-width="0.5" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <!-- Cabeçalho (Marca) -->
            <div class="relative z-10">
                <a href="/" class="flex items-center space-x-3 group inline-block">
                    <div class="h-9 w-9 bg-white/10 backdrop-blur-md border border-white/20 rounded-lg flex items-center justify-center p-1.5 shadow-sm">
                        <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold font-display text-white tracking-tight">PDV<span class="text-indigo-300">Easy</span></span>
                </a>
            </div>

            <!-- Centro: Mensagem Principal e Simulação de Segurança -->
            <div class="relative z-10 my-auto max-w-lg space-y-12">
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight font-display">
                        Gestão simplificada, caixa protegido.
                    </h1>
                    <p class="text-base lg:text-lg text-indigo-100/80 leading-relaxed font-light">
                        Gerencie suas vendas, estoque e finanças em um só lugar com segurança de nível empresarial. A melhor experiência para o seu operador de caixa.
                    </p>
                </div>

                <!-- Simulação de Cards Flutuantes (Segurança / Status) -->
                <div class="space-y-4">
                    <!-- Card 1: Conexão Segura -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 flex items-center justify-between hover:bg-white/15 transition-all duration-300 transform hover:scale-[1.02] shadow-xl shadow-black/10">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-white">Conexão Segura SSL</h3>
                                <p class="text-xs text-indigo-200/70">Dados de transação criptografados de ponta a ponta</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/20 px-2 py-0.5 rounded-full uppercase tracking-wider">Ativo</span>
                    </div>

                    <!-- Card 2: Sessão Ativa -->
                    <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 flex items-center justify-between hover:bg-white/15 transition-all duration-300 transform hover:scale-[1.02] shadow-xl shadow-black/10">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-400/20 text-indigo-300 flex items-center justify-center">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 009 11.571V9a4 4 0 018 0v1.571c0 1.83.447 3.55 1.238 5.06l.047.089M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-white">Sessão Compartilhada</h3>
                                <p class="text-xs text-indigo-200/70">Terminal caixa conectado no terminal Alfa-01</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-indigo-300 bg-indigo-400/20 px-2 py-0.5 rounded-full uppercase tracking-wider">OK</span>
                    </div>
                </div>
            </div>

            <!-- Rodapé da Esquerda -->
            <div class="relative z-10 flex items-center justify-between text-xs text-indigo-200/60 border-t border-white/10 pt-6">
                <span>Versão do Caixa: v2.42.1</span>
                <span>PDV Easy &copy; {{ date('Y') }}</span>
            </div>
        </div>

        <!-- Coluna da Direita: Formulário de Login (Sempre visível) -->
        <div class="lg:col-span-6 flex flex-col justify-center bg-white p-8 sm:p-12 lg:p-20 relative">
            <!-- Grid de Background opcional para mobile para não ficar muito vazio -->
            <div class="absolute inset-0 pointer-events-none opacity-[0.03] lg:hidden">
                <svg class="w-full h-full text-indigo-900" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-mob" width="30" height="30" patternUnits="userSpaceOnUse">
                            <rect width="30" height="30" fill="none" stroke="currentColor" stroke-width="1" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid-mob)" />
                </svg>
            </div>

            <div class="max-w-md w-full mx-auto space-y-10 relative z-10">
                
                <!-- Cabeçalho do Formulário -->
                <div class="space-y-4">
                    <!-- Logo Discreta para Mobile -->
                    <div class="lg:hidden flex items-center space-x-2.5 mb-6">
                        <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center p-1.5 shadow-sm shadow-indigo-200">
                            <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold font-display text-slate-900 tracking-tight">PDV<span class="text-indigo-600">Easy</span></span>
                    </div>

                    <h2 class="text-3xl font-bold font-display text-slate-900 tracking-tight">
                        Boas-vindas de volta
                    </h2>
                    <p class="text-sm text-slate-500 font-light">
                        Insira suas credenciais corporativas para acessar o caixa.
                    </p>
                </div>

                <!-- Formulário principal -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="p-3.5 bg-rose-50 border border-rose-100 text-rose-600 text-xs rounded-xl space-y-1 shadow-sm font-medium">
                            @foreach ($errors->all() as $error)
                                <p class="flex items-center">
                                    <svg class="mr-1.5 h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    {{ $error }}
                                </p>
                            @endforeach
                        </div>
                    @endif
                    <!-- Campo de E-mail -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            E-mail Corporativo
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required autocomplete="email" placeholder="nome@empresa.com.br"
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Campo de Senha -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-xs font-semibold text-slate-700 tracking-wide block">
                                Sua Senha
                            </label>
                        </div>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required autocomplete="current-password" placeholder="••••••••"
                                class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Linha de Utilitários -->
                    <div class="flex items-center justify-between text-xs pt-1">
                        <!-- Lembrar-me -->
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4.5 w-4.5 text-indigo-600 focus:ring-indigo-500/30 border-slate-300 rounded-md cursor-pointer transition-colors duration-200">
                            <label for="remember-me" class="ml-2 font-medium text-slate-600 cursor-pointer select-none">
                                Lembrar-me
                            </label>
                        </div>

                        <!-- Esqueceu a senha? -->
                        <div>
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-150">
                                Esqueceu a senha?
                            </a>
                        </div>
                    </div>

                    <!-- Botão de Ação -->
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold tracking-wide shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 cursor-pointer">
                        Acessar o Caixa
                        <svg class="ml-2 -mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14.5" />
                        </svg>
                    </button>
                </form>

                <!-- Rodapé do Formulário -->
                <p class="text-center text-xs text-slate-500 font-light pt-4 border-t border-slate-100">
                    Não tem uma conta? <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-150">Cadastre-se</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
