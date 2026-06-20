<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV Easy - O PDV que acelera suas vendas e simplifica seu estoque</title>
    
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
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col pt-20">

    <!-- Menu de Navegação (Navbar) -->
    <nav class="fixed top-0 left-0 right-0 h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 shadow-sm z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto h-full px-6 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-3 group">
                <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-between p-2 shadow-md shadow-indigo-200 group-hover:scale-105 transition-transform duration-300">
                    <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold font-display text-slate-900 tracking-tight">PDV<span class="text-indigo-600">Easy</span></span>
            </a>

            <!-- Links de Navegação -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#funcionalidades" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Funcionalidades</a>
                <a href="#planos" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Planos</a>
                <a href="#suporte" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors duration-200">Suporte</a>
            </div>

            <!-- Botão de Ação -->
            <div class="flex items-center space-x-4">
                <a href="/register" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors duration-200">
                    Cadastre-se
                </a>
                <a href="/login" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100 hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-200">
                    Entrar no Sistema
                </a>
            </div>
        </div>
    </nav>

    <!-- Seção Principal (Hero) -->
    <section class="relative py-20 lg:py-28 overflow-hidden bg-gradient-to-b from-white to-slate-50">
        <!-- Detalhes de Background (Gradientes decorativos) -->
        <div class="absolute inset-0 pointer-events-none opacity-40">
            <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-indigo-200 filter blur-3xl"></div>
            <div class="absolute top-1/2 -left-40 w-96 h-96 rounded-full bg-blue-100 filter blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Coluna da Esquerda (Texto e CTAs) -->
                <div class="lg:col-span-6 space-y-8 text-left max-w-2xl mx-auto lg:mx-0">
                    <!-- Badge de Lançamento -->
                    <div class="inline-flex items-center space-x-2 bg-indigo-50 border border-indigo-100/50 rounded-full px-4 py-1.5 text-xs font-semibold text-indigo-700 tracking-wide">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                        </span>
                        <span>PDV na Nuvem da Nova Geração</span>
                    </div>

                    <!-- Título Gigante -->
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1]">
                        O PDV que acelera suas <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-500">vendas</span> e simplifica seu <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-indigo-600">estoque</span>
                    </h1>

                    <!-- Descrição -->
                    <p class="text-lg text-slate-600 leading-relaxed font-light">
                        Venda em segundos, gerencie seu estoque automaticamente e visualize o lucro real da sua empresa de qualquer dispositivo. Diga adeus aos caixas lentos e planilhas complicadas.
                    </p>

                    <!-- Botões de Ação -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
                        <a href="/register" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-xl shadow-indigo-100 hover:shadow-2xl hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all duration-200 text-center">
                            Experimentar Grátis
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="#contato" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200/80 shadow-sm hover:shadow hover:-translate-y-0.5 transition-all duration-200 text-center">
                            Falar com Consultor
                        </a>
                    </div>

                    <!-- Trust indicators / Prova Social rápida -->
                    <div class="pt-6 border-t border-slate-100 flex items-center space-x-6">
                        <div class="flex -space-x-2">
                            <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-indigo-500 text-xs font-bold text-white flex items-center justify-center">MD</span>
                            <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-blue-500 text-xs font-bold text-white flex items-center justify-center">JC</span>
                            <span class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-slate-600 text-xs font-bold text-white flex items-center justify-center">LS</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium">
                            Confiado por mais de <span class="font-bold text-slate-800">1.200 comerciantes</span> em todo o Brasil.
                        </p>
                    </div>
                </div>

                <!-- Coluna da Direita (Painel/Dashboard Simulado) -->
                <div class="lg:col-span-6 relative">
                    <!-- Elemento decorativo de fundo do painel -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-indigo-300 rounded-3xl rotate-2 opacity-10 filter blur-xl scale-95"></div>
                    
                    <!-- Container Principal do Dashboard -->
                    <div class="relative bg-white rounded-3xl border border-slate-200/70 shadow-2xl overflow-hidden p-6 hover:shadow-indigo-100/50 transition-shadow duration-300">
                        <!-- Barra Superior do Dashboard -->
                        <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                            <div class="flex items-center space-x-2">
                                <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                <span class="pl-2 text-xs font-semibold text-slate-400 select-none tracking-wider">PDV EASY DASHBOARD</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors cursor-pointer">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <span class="h-7 w-[1px] bg-slate-100"></span>
                                <div class="flex items-center space-x-2 cursor-pointer">
                                    <span class="text-xs font-semibold text-slate-700">Mercado Alfa</span>
                                    <div class="w-7 h-7 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">MA</div>
                                </div>
                            </div>
                        </div>

                        <!-- Grid de Indicadores Principais (KPIs) -->
                        <div class="grid grid-cols-3 gap-4 py-6">
                            <!-- Card KPI 1 -->
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 hover:bg-slate-100/50 transition-colors duration-200">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Vendas Hoje</span>
                                <div class="flex items-baseline space-x-1">
                                    <span class="text-lg font-bold text-slate-800">R$ 4.820</span>
                                </div>
                                <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded mt-2 inline-block">+14.2%</span>
                            </div>

                            <!-- Card KPI 2 -->
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 hover:bg-slate-100/50 transition-colors duration-200">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Itens Vendidos</span>
                                <div class="flex items-baseline space-x-1">
                                    <span class="text-lg font-bold text-slate-800">142</span>
                                </div>
                                <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded mt-2 inline-block">+8.1%</span>
                            </div>

                            <!-- Card KPI 3 -->
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 hover:bg-slate-100/50 transition-colors duration-200">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Ticket Médio</span>
                                <div class="flex items-baseline space-x-1">
                                    <span class="text-lg font-bold text-slate-800">R$ 33,94</span>
                                </div>
                                <span class="text-[10px] font-semibold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded mt-2 inline-block">Estável</span>
                            </div>
                        </div>

                        <!-- Bloco Visual do Gráfico -->
                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-xs font-bold text-slate-700">Faturamento da Semana</h4>
                                <span class="text-[10px] font-semibold text-slate-400">Últimos 7 dias</span>
                            </div>
                            <!-- Gráfico Simulado em SVG -->
                            <div class="w-full h-32 relative flex items-end">
                                <svg class="w-full h-full text-indigo-600/10" viewBox="0 0 100 100" preserveAspectRatio="none">
                                    <!-- Gradiente por baixo da linha -->
                                    <defs>
                                        <linearGradient id="gradient-chart" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#4f46e5" stop-opacity="0.3"></stop>
                                            <stop offset="100%" stop-color="#4f46e5" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                    <!-- Área preenchida -->
                                    <path d="M 0 90 Q 20 60 40 75 T 80 30 T 100 20 L 100 100 L 0 100 Z" fill="url(#gradient-chart)"></path>
                                    <!-- Linha do gráfico -->
                                    <path d="M 0 90 Q 20 60 40 75 T 80 30 T 100 20" fill="none" stroke="#4f46e5" stroke-width="2.5" stroke-linecap="round"></path>
                                </svg>
                                
                                <!-- Eixo X com dias simulados -->
                                <div class="absolute bottom-0 left-0 right-0 flex justify-between px-1 text-[9px] font-bold text-slate-400 select-none translate-y-1">
                                    <span>Seg</span>
                                    <span>Ter</span>
                                    <span>Qua</span>
                                    <span>Qui</span>
                                    <span>Sex</span>
                                    <span>Sáb</span>
                                    <span>Dom</span>
                                </div>
                                
                                <!-- Ponto interativo destacado no gráfico -->
                                <div class="absolute top-[28%] left-[80%] -translate-x-1/2 -translate-y-1/2 group">
                                    <span class="flex h-3.5 w-3.5 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-indigo-600 border-2 border-white"></span>
                                    </span>
                                    <!-- Tooltip flutuante -->
                                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-2 py-1 rounded-md shadow-lg whitespace-nowrap opacity-100 transition-opacity duration-200 pointer-events-none">
                                        Sábado: R$ 1.840,00
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seção de "Últimas Vendas" no PDV -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-xs font-bold text-slate-700">Últimas Vendas no Caixa</h4>
                                <a href="#" class="text-[10px] font-semibold text-indigo-600 hover:text-indigo-700">Ver todas</a>
                            </div>
                            <div class="space-y-2.5">
                                <div class="flex items-center justify-between bg-slate-50/50 p-2.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Venda #1024</p>
                                            <p class="text-[10px] text-slate-400">Há 2 min • Dinheiro</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-800">R$ 150,00</span>
                                </div>

                                <div class="flex items-center justify-between bg-slate-50/50 p-2.5 rounded-xl border border-slate-100 hover:bg-slate-50 transition-colors duration-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Venda #1023</p>
                                            <p class="text-[10px] text-slate-400">Há 5 min • Cartão de Crédito</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-800">R$ 89,90</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Seção de Benefícios (Features) -->
    <section id="funcionalidades" class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Cabeçalho da Seção -->
            <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-20 space-y-4">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-3.5 py-1.5 rounded-full">Recursos Elite</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 tracking-tight">
                    Por que escolher nosso PDV?
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed font-light">
                    Desenvolvido para atender desde pequenos negócios a grandes redes comerciais com a mesma estabilidade e agilidade.
                </p>
            </div>

            <!-- Grid de Features -->
            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Card 1: Frente de Caixa -->
                <div class="bg-white rounded-3xl p-8 border border-slate-100 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-50/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-6">
                        <!-- Ícone do Card -->
                        <div class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Frente de Caixa Ultra Rápido</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-light">
                            Faça vendas em menos de 3 segundos. Sistema otimizado para teclado ou touch, aceita Pix integrado, cartões e dinheiro sem travamentos ou lentidão durante o atendimento.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-50">
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 inline-flex items-center space-x-1">
                            <span>Saiba mais</span>
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Estoque Automatizado -->
                <div class="bg-white rounded-3xl p-8 border border-slate-100 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-50/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-6">
                        <!-- Ícone do Card -->
                        <div class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Estoque Automatizado</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-light">
                            Baixa automática a cada venda efetuada no PDV. Receba alertas inteligentes de reposição antes do produto acabar, controle lotes e datas de validade de forma simples.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-50">
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 inline-flex items-center space-x-1">
                            <span>Saiba mais</span>
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Relatórios em Tempo Real -->
                <div class="bg-white rounded-3xl p-8 border border-slate-100 hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-50/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div class="space-y-6">
                        <!-- Ícone do Card -->
                        <div class="h-12 w-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Relatórios em Tempo Real</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-light">
                            Tenha uma visão 360° do seu faturamento, lucros líquidos, custos e comissão de colaboradores direto no painel, tudo atualizado em tempo real e acessível do celular.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-50">
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 inline-flex items-center space-x-1">
                            <span>Saiba mais</span>
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Rodapé (Footer) -->
    <footer class="mt-auto bg-slate-900 text-slate-400 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Info do Logo -->
            <div class="flex items-center space-x-3">
                <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center p-1.5 shadow-md">
                    <svg class="h-full w-full text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-bold font-display text-white tracking-tight">PDV<span class="text-indigo-500">Easy</span></span>
            </div>

            <!-- Direitos Autorais -->
            <p class="text-xs text-slate-500 font-light text-center md:text-left">
                &copy; {{ date('Y') }} PDV Easy. Todos os direitos reservados.
            </p>

            <!-- Links Adicionais -->
            <div class="flex items-center space-x-6">
                <a href="#" class="text-xs text-slate-500 hover:text-white transition-colors duration-200">Termos de Serviço</a>
                <a href="#" class="text-xs text-slate-500 hover:text-white transition-colors duration-200">Política de Privacidade</a>
            </div>
        </div>
    </footer>

</body>
</html>
