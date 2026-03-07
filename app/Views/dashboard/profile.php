<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - NutriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/profile.css') ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a',
                        accent: '#86efac'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto">
        <!-- Profile Header -->
        <header class="profile-header">
            <div class="header-bg"></div>
            <div class="header-content">
                <div class="avatar-container">
                    <div class="avatar">J</div>
                    <button class="avatar-edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
                <h1 class="profile-name">João Silva</h1>
                <p class="profile-email">joao.silva@email.com</p>
                <button class="edit-profile-btn" onclick="openEditModal()">
                    ✏️ Editar Perfil
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-4 pb-24 space-y-4" style="margin-top: -2rem;">
            <!-- Stats Grid -->
            <section class="stats-grid">
                <div class="stat-card">
                    <p class="stat-label">Peso Atual</p>
                    <p class="stat-value">75 <span>kg</span></p>
                </div>
                <div class="stat-card highlight">
                    <p class="stat-label">Meta de Peso</p>
                    <p class="stat-value">70 <span>kg</span></p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Altura</p>
                    <p class="stat-value">175 <span>cm</span></p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">IMC</p>
                    <p class="stat-value bmi-normal">24.5</p>
                    <p class="stat-sublabel">Normal</p>
                </div>
            </section>

            <!-- Calorie Goal -->
            <section class="calorie-goal-section">
                <div class="section-header">
                    <h2>Meta Calórica Diária</h2>
                    <button class="adjust-btn" onclick="openCalorieModal()">Ajustar</button>
                </div>
                <div class="calorie-goal-content">
                    <div class="calorie-icon">🔥</div>
                    <div class="calorie-info">
                        <p class="calorie-value">2,000</p>
                        <p class="calorie-unit">calorias por dia</p>
                    </div>
                </div>
                <p class="calorie-note">* Baseado no seu perfil e nível de atividade: Moderadamente Ativo</p>
            </section>

            <!-- Activity Level -->
            <section class="activity-section">
                <h2>Nível de Atividade</h2>
                <div class="activity-options">
                    <button class="activity-option">
                        <span class="activity-emoji">🛋️</span>
                        <div class="activity-info">
                            <p class="activity-title">Sedentário</p>
                            <p class="activity-desc">Pouco ou nenhum exercício</p>
                        </div>
                    </button>
                    <button class="activity-option">
                        <span class="activity-emoji">🚶</span>
                        <div class="activity-info">
                            <p class="activity-title">Levemente Ativo</p>
                            <p class="activity-desc">Exercício leve 1-3 dias/semana</p>
                        </div>
                    </button>
                    <button class="activity-option active">
                        <span class="activity-emoji">🏃</span>
                        <div class="activity-info">
                            <p class="activity-title">Moderadamente Ativo</p>
                            <p class="activity-desc">Exercício moderado 3-5 dias/semana</p>
                        </div>
                        <span class="activity-check">✓</span>
                    </button>
                    <button class="activity-option">
                        <span class="activity-emoji">💪</span>
                        <div class="activity-info">
                            <p class="activity-title">Muito Ativo</p>
                            <p class="activity-desc">Exercício intenso 6-7 dias/semana</p>
                        </div>
                    </button>
                    <button class="activity-option">
                        <span class="activity-emoji">🏋️</span>
                        <div class="activity-info">
                            <p class="activity-title">Extremamente Ativo</p>
                            <p class="activity-desc">Exercício muito intenso ou trabalho físico</p>
                        </div>
                    </button>
                </div>
            </section>

            <!-- Settings -->
            <section class="settings-section">
                <h2>Configurações</h2>
                <div class="settings-list">
                    <button class="setting-item">
                        <div class="setting-info">
                            <span class="setting-icon">🔔</span>
                            <div>
                                <p class="setting-title">Notificações</p>
                                <p class="setting-desc">Lembretes de refeições e água</p>
                            </div>
                        </div>
                        <div class="toggle-switch active" onclick="toggleSwitch(this, event)"></div>
                    </button>
                    <button class="setting-item">
                        <div class="setting-info">
                            <span class="setting-icon">🌙</span>
                            <div>
                                <p class="setting-title">Modo Escuro</p>
                                <p class="setting-desc">Em breve</p>
                            </div>
                        </div>
                        <div class="toggle-switch" onclick="toggleSwitch(this, event)"></div>
                    </button>
                    <button class="setting-item">
                        <div class="setting-info">
                            <span class="setting-icon">📤</span>
                            <div>
                                <p class="setting-title">Exportar Dados</p>
                                <p class="setting-desc">Baixar histórico em JSON</p>
                            </div>
                        </div>
                        <svg class="setting-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <button class="setting-item danger">
                        <div class="setting-info">
                            <span class="setting-icon">🗑️</span>
                            <div>
<button class="setting-item" onclick="logout()">
    <div class="setting-info">
        <span class="setting-icon">🚪</span>
        <div>
            <p class="setting-title">Sair da Conta</p>
            <p class="setting-desc">Encerrar sessão atual</p>
        </div>
    </div>
    <svg class="setting-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</button>
                                <p class="setting-title">Resetar Dados</p>
                                <p class="setting-desc">Apagar todo o histórico</p>
                            </div>
                        </div>
                        <svg class="setting-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </section>

            <!-- App Info -->
            <div class="app-info">
                <p class="app-version">NutriTech v1.0.0</p>
                <p class="app-made">Feito com 💚 para sua saúde</p>
            </div>
        </main>

        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <a href="../dashboard/dashboard.html" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Início</span>
            </a>
            <a href="../recipes/recipes.html" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span>Receitas</span>
            </a>
            <button class="nav-item add-btn">
                <div class="add-btn-circle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span>Adicionar</span>
            </button>
            <a href="#" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span>Estatísticas</span>
            </a>
            <a href="profile.html" class="nav-item active">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Perfil</span>
            </a>
        </nav>
    </div>

    <!-- Edit Profile Modal -->
    <div id="edit-modal" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Perfil</h2>
                <button onclick="closeEditModal()" class="modal-close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form class="modal-form" onsubmit="saveProfile(event)">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" value="João Silva" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="joao.silva@email.com" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Peso Atual (kg)</label>
                        <input type="number" value="75" required>
                    </div>
                    <div class="form-group">
                        <label>Meta de Peso (kg)</label>
                        <input type="number" value="70" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Altura (cm)</label>
                        <input type="number" value="175" required>
                    </div>
                    <div class="form-group">
                        <label>Idade</label>
                        <input type="number" value="28" required>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <!-- Calorie Goal Modal -->
    <div id="calorie-modal" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Meta Calórica</h2>
                <button onclick="closeCalorieModal()" class="modal-close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="calorie-modal-body">
                <div class="calorie-input-section">
                    <p class="calorie-input-label">Meta diária de calorias</p>
                    <input type="number" id="calorie-input" value="2000" class="calorie-input">
                    <p class="calorie-input-unit">kcal</p>
                </div>
                <div class="calorie-suggestions">
                    <p class="suggestions-label">Sugestões baseadas no seu perfil:</p>
                    <button class="suggestion-btn" onclick="setCalorie(1700)">
                        <div>
                            <p class="suggestion-title">🔥 Perder peso</p>
                            <p class="suggestion-value">1,700 kcal/dia</p>
                        </div>
                    </button>
                    <button class="suggestion-btn" onclick="setCalorie(2000)">
                        <div>
                            <p class="suggestion-title">⚖️ Manter peso</p>
                            <p class="suggestion-value">2,000 kcal/dia</p>
                        </div>
                    </button>
                    <button class="suggestion-btn" onclick="setCalorie(2300)">
                        <div>
                            <p class="suggestion-title">💪 Ganhar massa</p>
                            <p class="suggestion-value">2,300 kcal/dia</p>
                        </div>
                    </button>
                </div>
                <button class="submit-btn" onclick="saveCalorie()">Salvar Meta</button>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/profile.js') ?>"></script>
    <script>
        function openEditModal() {
            document.getElementById('edit-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function saveProfile(e) {
            e.preventDefault();
            alert('Perfil atualizado!');
            closeEditModal();
        }

        function openCalorieModal() {
            document.getElementById('calorie-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCalorieModal() {
            document.getElementById('calorie-modal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function setCalorie(value) {
            document.getElementById('calorie-input').value = value;
        }

        function saveCalorie() {
            alert('Meta calórica atualizada!');
            closeCalorieModal();
        }

        function toggleSwitch(element, event) {
            event.stopPropagation();
            element.classList.toggle('active');
        }

        // Activity selection
        document.querySelectorAll('.activity-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.activity-option').forEach(o => {
                    o.classList.remove('active');
                    const check = o.querySelector('.activity-check');
                    if (check) check.remove();
                });
                option.classList.add('active');
                if (!option.querySelector('.activity-check')) {
                    const check = document.createElement('span');
                    check.className = 'activity-check';
                    check.textContent = '✓';
                    option.appendChild(check);
                }
            });
        });
    </script>
</body>
</html>