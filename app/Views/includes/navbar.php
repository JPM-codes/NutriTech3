<!-- Header -->
<header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <div class="relative" id="user-menu">
                    <button class="flex items-center gap-2 p-1 hover:bg-gray-100 rounded-full transition-colors" onclick="toggleUserMenu()">
                        <div class="w-9 h-9 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-sm" id="user-avatar"><?= esc(user()['name'][0]) ?></div>
                    </button>

                    <div id="user-dropdown" class="hidden absolute right-0 top-12 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="font-semibold text-gray-800" id="dropdown-name"><?= esc(user()['name']) ?></p>
                            <p class="text-sm text-gray-500" id="dropdown-email"><?= esc(user()['email']) ?></p>
                        </div>
                        <div class="py-1">
                            <a href="<?= base_url('perfil') ?>">
                                <button class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-50 text-gray-700 text-left">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Meu Perfil
                                </button>
                            </a>
                            <a href="<?= base_url('perfil') ?>">
                                <button class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-50 text-gray-700 text-left">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Configurações
                                </button>
                            </a>
                            <?php if (user()['email'] === 'admin@nutritech.com'): ?>
                                <a href="<?= base_url('admin') ?>">
                                    <button class="w-full flex items-center gap-3 px-4 py-2 hover:bg-purple-50 text-purple-600 text-left">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 3a3.75 3.75 0 00-3.75 3.75v1.5H5.25A2.25 2.25 0 003 10.5v7.5A2.25 2.25 0 005.25 20.25h13.5A2.25 2.25 0 0021 18V10.5a2.25 2.25 0 00-2.25-2.25H18v-1.5A3.75 3.75 0 0014.25 3h-4.5z" />
                                        </svg>
                                        Painel Admin
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="border-t border-gray-100 pt-1">
                            <a href="<?= base_url('auth/logout') ?>" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-red-50 text-red-600 text-left">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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

<!-- Bottom Navigation (3 itens) -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-around py-2">
            <a href="<?= base_url('dashboard') ?>">
                <button class="nav-item <?= request()->getUri()->getSegment(1) === 'dashboard' ? 'active' : '' ?> flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="dashboard">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs mt-1">Início</span>
                </button>
            </a>

            <a href="<?= base_url('receitas') ?>">
                <button class="nav-item <?= request()->getUri()->getSegment(1) === 'receitas' ? 'active' : '' ?> flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="recipes">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-xs mt-1">Receitas</span>
                </button>
            </a>
            <a href="<?= base_url('perfil') ?>">
                <button class="nav-item <?= request()->getUri()->getSegment(1) === 'perfil' ? 'active' : '' ?> flex flex-col items-center py-2 px-6 rounded-xl transition-all" data-page="profile">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-xs mt-1">Perfil</span>
                </button>
            </a>
        </div>
    </div>
</nav>