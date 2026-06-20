<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar - PDV Easy</title>
    
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

            <!-- Centro: Mensagem Principal e Lista de Benefícios B2B -->
            <div class="relative z-10 my-auto max-w-lg space-y-12">
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight font-display">
                        Comece a transformar sua gestão hoje.
                    </h1>
                    <p class="text-base lg:text-lg text-indigo-100/80 leading-relaxed font-light">
                        Junte-se a milhares de lojistas e otimize suas operações comerciais de ponta a ponta com a nossa solução de caixa inteligente.
                    </p>
                </div>

                <!-- Lista de Benefícios B2B com Ícones de Check -->
                <div class="space-y-5">
                    <!-- Benefício 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center mt-0.5">
                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Configuração em 5 minutos</h3>
                            <p class="text-xs text-indigo-200/70">Importe seus produtos e comece a vender imediatamente</p>
                        </div>
                    </div>

                    <!-- Benefício 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center mt-0.5">
                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Suporte Técnico 24h</h3>
                            <p class="text-xs text-indigo-200/70">Atendimento humanizado via chat e WhatsApp a qualquer hora</p>
                        </div>
                    </div>

                    <!-- Benefício 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center mt-0.5">
                            <svg class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Teste grátis por 14 dias</h3>
                            <p class="text-xs text-indigo-200/70">Acesso completo a todas as funcionalidades sem cartão de crédito</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rodapé da Esquerda -->
            <div class="relative z-10 flex items-center justify-between text-xs text-indigo-200/60 border-t border-white/10 pt-6">
                <span>Plataforma Segura LGPD</span>
                <span>PDV Easy &copy; {{ date('Y') }}</span>
            </div>
        </div>

        <!-- Coluna da Direita: Formulário de Cadastro (Sempre visível) -->
        <div class="lg:col-span-6 flex flex-col justify-center bg-white p-8 sm:p-12 lg:p-20 relative">
            <!-- Grid de Background opcional para mobile -->
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

            <div class="max-w-md w-full mx-auto space-y-8 relative z-10">
                
                <!-- Cabeçalho do Formulário -->
                <div class="space-y-3">
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
                        Crie sua conta empresarial
                    </h2>
                    <p class="text-sm text-slate-500 font-light">
                        Preencha os dados abaixo para começar.
                    </p>
                </div>

                <!-- Formulário principal -->
                <form action="{{ route('register') }}" method="POST" class="space-y-5">
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

                    <!-- Campo de Nome Completo do Gestor -->
                    <div class="space-y-1.5">
                        <label for="name" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Nome Completo
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" required placeholder="Seu nome completo"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>
                    
                    <!-- Campo de Nome da Empresa -->
                    <div class="space-y-1.5">
                        <label for="company_name" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Nome da Empresa
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <input type="text" name="company_name" id="company_name" required placeholder="Ex: Mercado Central Ltda"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Campo de CNPJ -->
                    <div class="space-y-1.5">
                        <label for="cnpj" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            CNPJ
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <input type="text" name="cnpj" id="cnpj" required placeholder="00.000.000/0000-00" maxlength="18"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Campo de E-mail Corporativo -->
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            E-mail Corporativo
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required autocomplete="email" placeholder="gestor@empresa.com.br"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Campo de Senha -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Senha
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password" required placeholder="Mínimo 8 caracteres"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                        
                        <!-- Indicador de força de senha interativo -->
                        <div class="pt-1.5 space-y-1">
                            <div class="flex justify-between items-center text-[10px] font-semibold text-slate-400">
                                <span>Segurança da Senha:</span>
                                <span id="strength-label" class="text-slate-400">Vazia</span>
                            </div>
                            <div class="grid grid-cols-4 gap-1.5 h-1">
                                <div id="strength-bar-1" class="rounded bg-slate-100 transition-colors duration-300"></div>
                                <div id="strength-bar-2" class="rounded bg-slate-100 transition-colors duration-300"></div>
                                <div id="strength-bar-3" class="rounded bg-slate-100 transition-colors duration-300"></div>
                                <div id="strength-bar-4" class="rounded bg-slate-100 transition-colors duration-300"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Campo de Confirmação de Senha -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-700 tracking-wide block">
                            Confirmar Senha
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Repita a senha"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all duration-200 text-sm">
                        </div>
                    </div>

                    <!-- Termos de Serviço / Consentimento -->
                    <p class="text-[10px] text-slate-400 leading-normal font-light">
                        Ao clicar em criar conta, você concorda com nossos <a href="#" class="text-indigo-600 font-semibold hover:underline">Termos de Uso</a> e <a href="#" class="text-indigo-600 font-semibold hover:underline">Políticas de Privacidade</a>.
                    </p>

                    <!-- Botão de Ação -->
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold tracking-wide shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 cursor-pointer">
                        Criar Minha Conta e Começar
                        <svg class="ml-2 -mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>

                <!-- Rodapé do Formulário -->
                <p class="text-center text-xs text-slate-500 font-light pt-4 border-t border-slate-100">
                    Já possui uma conta? <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-700 transition-colors duration-150">Faça login</a>
                </p>
            </div>
        </div>

    </div>

    <!-- Script Simples e Leve para Máscara de CNPJ e Medidor de Força de Senha -->
    <script>
        // Máscara CNPJ simples
        const cnpjInput = document.getElementById('cnpj');
        cnpjInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 14) value = value.slice(0, 14);
            
            // Aplica formatação: 00.000.000/0000-00
            if (value.length > 12) {
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})$/, "$1.$2.$3/$4-$5");
            } else if (value.length > 8) {
                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{1,4})$/, "$1.$2.$3/$4");
            } else if (value.length > 5) {
                value = value.replace(/^(\d{2})(\d{3})(\d{1,3})$/, "$1.$2.$3");
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{1,3})$/, "$1.$2");
            }
            
            e.target.value = value;
        });

        // Medidor de Força de Senha
        const passwordInput = document.getElementById('password');
        const strengthLabel = document.getElementById('strength-label');
        const bar1 = document.getElementById('strength-bar-1');
        const bar2 = document.getElementById('strength-bar-2');
        const bar3 = document.getElementById('strength-bar-3');
        const bar4 = document.getElementById('strength-bar-4');

        passwordInput.addEventListener('input', function (e) {
            const val = e.target.value;
            let score = 0;
            
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            // Reseta cores
            [bar1, bar2, bar3, bar4].forEach(bar => {
                bar.className = 'rounded bg-slate-100 transition-colors duration-300';
            });

            if (val.length === 0) {
                strengthLabel.innerText = 'Vazia';
                strengthLabel.className = 'text-slate-400';
            } else if (score <= 1) {
                strengthLabel.innerText = 'Fraca';
                strengthLabel.className = 'text-red-500 font-bold';
                bar1.className = 'rounded bg-red-500 transition-colors duration-300';
            } else if (score === 2) {
                strengthLabel.innerText = 'Razoável';
                strengthLabel.className = 'text-yellow-500 font-bold';
                bar1.className = 'rounded bg-yellow-500 transition-colors duration-300';
                bar2.className = 'rounded bg-yellow-500 transition-colors duration-300';
            } else if (score === 3) {
                strengthLabel.innerText = 'Boa';
                strengthLabel.className = 'text-blue-500 font-bold';
                bar1.className = 'rounded bg-blue-500 transition-colors duration-300';
                bar2.className = 'rounded bg-blue-500 transition-colors duration-300';
                bar3.className = 'rounded bg-blue-500 transition-colors duration-300';
            } else if (score === 4) {
                strengthLabel.innerText = 'Excelente';
                strengthLabel.className = 'text-emerald-500 font-bold';
                bar1.className = 'rounded bg-emerald-500 transition-colors duration-300';
                bar2.className = 'rounded bg-emerald-500 transition-colors duration-300';
                bar3.className = 'rounded bg-emerald-500 transition-colors duration-300';
                bar4.className = 'rounded bg-emerald-500 transition-colors duration-300';
            }
        });
    </script>

</body>
</html>
