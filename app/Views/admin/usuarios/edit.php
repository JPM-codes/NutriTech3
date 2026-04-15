<?php if (session()->getFlashdata('success')): ?>
    <div id="modal-sucesso" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 opacity-100 transition-opacity duration-300 pointer-events-none">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 text-center animate-fadeIn">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-green-400 to-green-600 mb-6 shadow-lg">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-3">Sucesso!</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                <?= session()->getFlashdata('success') ?>
            </p>

            <div class="w-full bg-gray-200 rounded-full h-1 mt-8 overflow-hidden">
                <div class="bg-gradient-to-r from-green-400 to-green-600 h-1 rounded-full animate-shrink-bar"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal-sucesso');
            if (modal) {
                setTimeout(() => {
                    modal.classList.add('opacity-0');
                    setTimeout(() => {
                        modal.remove();
                    }, 300);
                }, 4000);
            }
        });
    </script>

    <style>
        @keyframes shrink-bar {
            from { width: 100%; }
            to { width: 0%; }
        }
        .animate-shrink-bar {
            animation: shrink-bar 4s linear forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .animate-fadeIn {
            animation: fadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
    </style>
<?php endif; ?>


<?php if (isset($_SESSION['error'])): ?>
    <?php $error = $_SESSION['error'];
    unset($_SESSION['error']); ?>

    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black/50 z-[9999] animate-fadeIn">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 animate-slideIn">
            <div class="flex items-center justify-center h-14 w-14 rounded-full bg-gradient-to-br from-red-400 to-red-600 mx-auto mb-6 shadow-lg">
                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4v2m0-10a9 9 0 110 18 9 9 0 010-18z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">Erro</h2>
            <p class="text-gray-600 text-center mb-8 leading-relaxed"><?= htmlspecialchars($error) ?></p>
            <div class="flex justify-end gap-3">
                <button onclick="closeModal()" class="px-6 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 hover:shadow-lg transition-all duration-200 flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            const modal = document.getElementById('errorModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.remove();
            }, 300);
        }
    </script>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-slideIn {
            animation: slideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
    </style>
<?php endif; ?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários - NutriTech</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a'
                    }
                }
            }
        }
    </script>

    <style>
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .gradient-green {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }

        .sidebar-item {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            color: #6b7280;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            transform: translateX(4px);
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
        }

        .sidebar-item svg {
            width: 20px;
            height: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            box-shadow: inset 0 0 0 2px #22c55e;
            border-color: #22c55e;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .table-row-hover:hover {
            background-color: #f3f4f6;
            box-shadow: inset 0 0 0 1px #e5e7eb;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }

        .animate-slide-in-down {
            animation: slideInDown 0.5s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-slate-50 via-slate-100 to-slate-50 min-h-screen">

    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-40 animate-slide-in-down">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="lg:hidden p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex items-center gap-2">
                    <div class="gradient-green rounded-lg p-2 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-400 bg-clip-text text-transparent">NutriTech</h1>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 hover:bg-gray-100 rounded-lg transition group">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                </button>

                <div class="relative group">
                    <button class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg transition">
                        <div class="w-10 h-10 gradient-green text-white flex items-center justify-center rounded-full font-bold shadow-lg">
                            <?= strtoupper(substr(session()->get('nome') ?? 'A', 0, 1)) ?>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-gray-900"><?= session()->get('nome') ?? 'Admin' ?></p>
                            <p class="text-xs text-gray-500">Administrador</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="<?= base_url('profile') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 first:rounded-t-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-sm">Meu Perfil</span>
                        </a>
                        <hr class="my-2">
                        <a href="<?= base_url('auth/logout') ?>" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 last:rounded-b-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm font-medium">Sair</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="flex pt-20">
        <!-- SIDEBAR -->
        <aside id="sidebar" class="fixed left-0 top-20 bottom-0 w-64 bg-white shadow-lg lg:translate-x-0 -translate-x-full transition-transform z-30 lg:z-20 overflow-y-auto">
            <div class="p-6 space-y-2">
                <a href="<?= base_url('admin') ?>" class="sidebar-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l-4-4m0 0l-4 4m4-4v4"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="<?= base_url('admin/usuarios') ?>" class="sidebar-item active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z"></path>
                    </svg>
                    <span class="font-medium">Usuários</span>
                </a>

                <a href="<?= base_url('admin/receitas') ?>" class="sidebar-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17.25c0 5.079 3.855 9.268 9 9.972m0-13c5.5 0 10 4.745 10 10.25 0 5.079-3.855 9.268-9 9.972"></path>
                    </svg>
                    <span class="font-medium">Receitas</span>
                </a>

                <a href="<?= base_url('admin/alimentos') ?>" class="sidebar-item">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <span class="font-medium">Alimentos</span>
                </a>

                <hr class="my-4">

                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-gray-500 uppercase px-4">Configurações</h3>
                    <a href="#" class="sidebar-item">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Configurações</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="flex-1 lg:ml-64">
            <div class="max-w-2xl mx-auto px-4 lg:px-8 py-8">

                <!-- HEADER -->
                <div class="mb-8 animate-fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <a href="<?= base_url('admin/usuarios') ?>" class="p-2 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900">Editar Usuário</h1>
                            <p class="text-gray-500 text-sm mt-1">Atualize as informações do usuário</p>
                        </div>
                    </div>
                </div>

                <!-- FORM CARD -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 card-hover animate-fade-in">
                    <form action="<?= base_url('admin/usuarios/atualizar/' . ($usuario['id'] ?? 0)) ?>" method="POST" class="space-y-6">
                        <?= csrf_field() ?>

                        <!-- NOME -->
                        <div class="form-group">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" name="nome" class="form-input" placeholder="Digite o nome completo" value="<?= esc($usuario['nome'] ?? '') ?>" required>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-input" placeholder="Digite o email" value="<?= esc($usuario['email'] ?? '') ?>" required>
                        </div>

                        <!-- SENHA -->
                        <div class="form-group">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-input" placeholder="Deixe em branco para manter a atual">
                            <p class="text-xs text-gray-500 mt-1">Apenas altere se deseja modificar a senha</p>
                        </div>

                        <!-- DADOS BIOMÉTRICOS -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- IDADE -->
                            <div class="form-group">
                                <label class="form-label">Idade</label>
                                <input type="number" name="idade" class="form-input" placeholder="Ex: 25" min="1" max="150" value="<?= esc($usuario['idade'] ?? '') ?>">
                            </div>

                            <!-- PESO -->
                            <div class="form-group">
                                <label class="form-label">Peso (kg)</label>
                                <input type="number" name="peso" class="form-input" placeholder="Ex: 70.5" step="0.1" min="0" value="<?= esc($usuario['peso'] ?? '') ?>">
                            </div>

                            <!-- ALTURA -->
                            <div class="form-group">
                                <label class="form-label">Altura (cm)</label>
                                <input type="number" name="altura" class="form-input" placeholder="Ex: 180" step="0.1" min="0" value="<?= esc($usuario['altura'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <a href="<?= base_url('admin/usuarios') ?>" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium text-center">
                                Cancelar
                            </a>
                            <button type="submit" class="flex-1 px-6 py-3 gradient-green text-white rounded-lg hover:shadow-lg transition font-medium">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Fechar sidebar ao clicar em um link
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });
        });
    </script>

</body>
</html>