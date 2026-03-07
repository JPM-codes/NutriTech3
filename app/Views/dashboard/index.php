
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriTech - Seu Assistente Nutricional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a',
                        accent: '#86efac',
                        dark: '#1a1a2e',
                        light: '#f0fdf4'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Splash Screen -->
    <div id="splash-screen" class="fixed inset-0 bg-gradient-to-br from-primary to-secondary flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="text-center">
            <div class="animate-bounce-slow">
                <svg class="w-24 h-24 mx-auto text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mt-4">NutriTech</h1>
            <p class="text-green-100 mt-2">Carregando...</p>
            <div class="mt-6">
                <div class="w-48 h-1 bg-green-200/30 rounded-full mx-auto overflow-hidden">
                    <div class="h-full bg-white rounded-full animate-loading"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- App Container -->
    <div id="app" class="opacity-0 transition-opacity duration-500">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">NutriTech</h1>
                            <p class="text-xs text-gray-500" id="current-date"></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <button class="p-2 hover:bg-gray-100 rounded-full transition-colors relative" id="notification-btn">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <div class="relative" id="user-menu">
                            <button class="flex items-center gap-2 p-1 hover:bg-gray-100 rounded-full transition-colors" onclick="toggleUserMenu()">
                                <div class="w-9 h-9 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-sm" id="user-avatar">J</div>
                            </button>
                            
                            <div id="user-dropdown" class="hidden absolute right-0 top-12 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="font-semibold text-gray-800" id="dropdown-name"><?= esc(session()->get('user_name')) ?></p>
                                    <p class="text-sm text-gray-500" id="dropdown-email"><?= esc(session()->get('user_email')) ?></p>
                                </div>
                                <div class="py-1">
                                    <button onclick="navigateToPage('profile'); toggleUserMenu();" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-50 text-gray-700 text-left">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Meu Perfil
                                    </button>
                                    <button class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-50 text-gray-700 text-left">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Configurações
                                    </button>
                                </div>
                                <div class="border-t border-gray-100 pt-1">
                                    <a href="<?= base_url('auth/logout') ?>" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-red-50 text-red-600 text-left">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sair da Conta
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main id="main-content" class="pb-20"></main>

        <!-- Bottom Navigation (3 itens) -->
        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-around py-2">
                    <button class="nav-item active flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="dashboard">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="text-xs mt-1">Início</span>
                    </button>
                    <button class="nav-item flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="recipes">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span class="text-xs mt-1">Receitas</span>
                    </button>
                    <button class="nav-item flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="profile">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-xs mt-1">Perfil</span>
                    </button>
                </div>
            </div>
        </nav>
    </div>

    <!-- Add Food Modal (usado pelos botões + nas refeições) -->
    <div id="add-food-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-hidden animate-slide-up">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Adicionar Alimento</h2>
                <button id="close-modal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <div class="relative mb-4">
                    <input type="text" id="food-search" placeholder="Buscar alimento..." class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Refeição</label>
                    <div class="grid grid-cols-4 gap-2">
                        <button class="meal-type-btn active py-2 px-3 rounded-lg text-xs font-medium transition-all" data-meal="breakfast">☀️ Café</button>
                        <button class="meal-type-btn py-2 px-3 rounded-lg text-xs font-medium transition-all" data-meal="lunch">🍽️ Almoço</button>
                        <button class="meal-type-btn py-2 px-3 rounded-lg text-xs font-medium transition-all" data-meal="dinner">🌙 Jantar</button>
                        <button class="meal-type-btn py-2 px-3 rounded-lg text-xs font-medium transition-all" data-meal="snack">🍎 Lanche</button>
                    </div>
                </div>

                <div class="max-h-60 overflow-y-auto" id="food-list"></div>

                <div class="mt-4 pt-4 border-t border-gray-100">
                    <button id="quick-add-btn" class="w-full py-3 bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-700 font-medium transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Adicionar manualmente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Add Form Modal -->
    <div id="quick-add-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md animate-slide-up">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Adicionar Manualmente</h2>
                <button id="close-quick-modal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="quick-add-form" class="p-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome do alimento</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="Ex: Banana">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Calorias</label>
                        <input type="number" name="calories" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Porção (g)</label>
                        <input type="number" name="portion" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="100">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Proteína (g)</label>
                        <input type="number" name="protein" class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Carbos (g)</label>
                        <input type="number" name="carbs" class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gordura (g)</label>
                        <input type="number" name="fat" class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50" placeholder="0">
                    </div>
                </div>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium hover:opacity-90 transition-opacity">
                    Adicionar Alimento
                </button>
            </form>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed top-20 left-1/2 -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-xl shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300 transform -translate-y-2">
        <span id="toast-message"></span>
    </div>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="base_url('assets/js/dashboard.js')"></script>
    <script src="base_url('assets/js/recipes.js')"></script>
    <script src="base_url('assets/js/profile.js')"></script>
</body>
</html>