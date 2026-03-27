<div class="p-4 space-y-6 animate-fade-in">
    <!-- Profile Header -->
    <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-3xl font-bold text-primary">
                <?= $user['nome'][0] ?>
            </div>
            <div>
                <h2 class="text-xl font-bold"><?= $user['nome'] ?></h2>
                <p class="text-green-100"><?= $user['email'] ?></p>
                <button onclick="openEditProfile()" class="mt-2 px-3 py-1 bg-white/20 rounded-full text-sm hover:bg-white/30 transition-colors">
                    ✏️ Editar perfil
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Peso Atual</p>
            <p class="text-2xl font-bold text-gray-800"><?= round($user['peso']) ?> <span class="text-sm font-normal">kg</span></p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border-2 border-primary/20">
            <p class="text-sm text-gray-500">Meta de Peso</p>
            <p class="text-2xl font-bold text-primary" id="meta-peso"><?= $meta['meta_peso'] ?> <span class="text-sm font-normal">kg</span></p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">Altura</p>
            <p class="text-2xl font-bold text-gray-800"><?= $user['altura'] ?> <span class="text-sm font-normal">cm</span></p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm">
            <p class="text-sm text-gray-500">IMC</p>
            <p class="text-2xl font-bold ${bmiCategory.color}"><?= calcularIMC($user['peso'], $user['altura']) ?></p>
            <p class="text-xs text-gray-400"><?= imc($user['peso'], $user['altura']) ?></p>
        </div>
    </div>

    <!-- Daily Goal -->
    <div class="bg-white rounded-2xl p-4 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-gray-800">Meta Calórica Diária</h3>
            <button onclick="openCalorieGoalModal()" class="text-primary text-sm font-medium hover:underline">Ajustar</button>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-full flex items-center justify-center">
                <span class="text-2xl">🔥</span>
            </div>
            <div class="flex-1">
                <p class="text-3xl font-bold text-gray-800" id="meta-calorias"> <?= $meta['meta_calorias'] ?> kcal</p>
                <p class="text-sm text-gray-500">calorias por dia</p>
            </div>
        </div>
    </div>

    <!-- Activity Level -->
    <div class="bg-white rounded-2xl p-4 shadow-sm">
        <h3 class="font-semibold text-gray-800 mb-4">Nível de Atividade</h3>

        <div class="space-y-2">
            <?= activity_option('1', 'Sedentário', 'Pouco ou nenhum exercício', '🛋️', $meta['nivel_atividade']) ?>

            <?= activity_option('2', 'Levemente Ativo', 'Exercício leve 1-3 dias/semana', '🚶', $meta['nivel_atividade'] ?? null) ?>

            <?= activity_option('3', 'Moderadamente Ativo', 'Exercício moderado 3-5 dias/semana', '🏃', $meta['nivel_atividade'] ?? null) ?>

            <?= activity_option('4', 'Muito Ativo', 'Exercício intenso 6-7 dias/semana', '💪', $meta['nivel_atividade'] ?? null) ?>
        </div>
    </div>

    <!-- Settings -->
    <div id="configuracoes" class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <h3 class="font-semibold text-gray-800 p-4 border-b border-gray-100">Configurações</h3>

        <!-- LOGOUT BUTTON -->
        <a href="<?= base_url('auth/logout') ?>">
            <button class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <span class="text-xl">🚪</span>
                    <div class="text-left">
                        <p class="font-medium text-red-600">Sair da Conta</p>
                        <p class="text-xs text-red-400">Encerrar sessão atual</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        </a>
            
        <button onclick="resetData()" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors">
            <div class="flex items-center gap-3">
                <span class="text-xl">🗑️</span>
                <div class="text-left">
                    <p class="font-medium text-red-600">Resetar Dados</p>
                    <p class="text-xs text-red-400">Apagar todo o histórico</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <!-- App Info -->
    <div class="text-center py-4">
        <p class="text-sm text-gray-400">NutriTech v1.0.0</p>
        <p class="text-xs text-gray-300 mt-1">Feito com 💚 para sua saúde</p>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md animate-slide-up">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Editar Perfil</h2>
            <button onclick="closeEditProfile()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="edit-profile-form" method="post" action="<?= base_url('perfil/atualizarPerfil') ?>" class="p-4 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="name" value="<?= $user['nome'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Peso Atual (kg)</label>
                    <input type="number" name="currentWeight" value="<?= $user['peso'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta de Peso (kg)</label>
                    <input type="number" name="targetWeight" value="<?= $meta['meta_peso'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Altura (cm)</label>
                    <input type="number" name="height" value="<?= $user['altura'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Idade</label>
                    <input type="number" name="age" value="<?= $user['idade'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium">
                Salvar Alterações
            </button>
        </form>
    </div>
</div>

<!-- Calorie Goal Modal -->
<div id="calorie-goal-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md animate-slide-up">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Meta Calórica</h2>
            <button onclick="closeCalorieGoalModal()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4 space-y-4">
            <div class="text-center py-4">
                <p class="text-sm text-gray-500 mb-2">Meta diária de calorias</p>
                <input type="number" id="calorie-goal-input" value="<?= $meta['meta_calorias'] ?>" class="text-4xl font-bold text-center text-gray-800 bg-transparent w-32 focus:outline-none">
                <p class="text-gray-500">kcal</p>
            </div>

            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm text-gray-600 mb-2">Sugestões:</p>
                <div class="space-y-2">
                    <button onclick="setCalorieGoal(${calculateSuggestedCalories('lose')})" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                        <p class="font-medium text-gray-800">🔥 Perder peso</p>
                        <p class="text-sm text-gray-500">${formatNumber(calculateSuggestedCalories('lose'))} kcal/dia</p>
                    </button>
                    <button onclick="setCalorieGoal(${calculateSuggestedCalories('maintain')})" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                        <p class="font-medium text-gray-800">⚖️ Manter peso</p>
                        <p class="text-sm text-gray-500">${formatNumber(calculateSuggestedCalories('maintain'))} kcal/dia</p>
                    </button>
                    <button onclick="setCalorieGoal(${calculateSuggestedCalories('gain')})" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                        <p class="font-medium text-gray-800">💪 Ganhar massa</p>
                        <p class="text-sm text-gray-500">${formatNumber(calculateSuggestedCalories('gain'))} kcal/dia</p>
                    </button>
                </div>
            </div>

            <button onclick="saveCalorieGoal()" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium hover:opacity-90 transition-opacity">
                Salvar Meta
            </button>
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

    // Adicionamos 'botaoClicado' como o primeiro parâmetro
    function enviarAtualizacao(botaoClicado, url, nivel) {

        // Captura os valores de calorias e peso dos inputs
        const inputCalorias = document.getElementById('meta-calorias');
        const inputPeso = document.getElementById('meta-peso');

        const calorias = inputCalorias ? inputCalorias.value : null;
        const peso = inputPeso ? inputPeso.value : null;

        const dados = {
            nivel: nivel,
            calorias: calorias,
            peso: peso
        };

        // 1. Desabilita o botão para evitar cliques duplos durante o processamento
        if (botaoClicado) botaoClicado.disabled = true;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Descomente se o seu backend exigir
                },
                body: JSON.stringify(dados)
            })
            .then(response => {
                // 2. Garante que erros do servidor (4xx, 5xx) sejam jogados para o catch
                if (!response.ok) {
                    throw new Error(`Erro no servidor: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    atualizarCoresDosBotoes(botaoClicado);
                    // Opcional: Mostrar uma mensagem visual de sucesso para o usuário aqui
                } else {
                    console.error('Erro retornado pela API:', data.message || 'Erro desconhecido');
                }
            })
            .catch(erro => {
                console.error('Erro de conexão ou servidor:', erro);
                // Opcional: Mostrar um alert() ou toast avisando o usuário sobre a falha
            })
            .finally(() => {
                // 3. Reabilita o botão independentemente de sucesso ou falha
                if (botaoClicado) botaoClicado.disabled = false;
            });
    }

    function atualizarCoresDosBotoes(botaoAtivo) {
        // 1. Pega todos os botões de atividade na tela
        const todosBotoes = document.querySelectorAll('.btn-atividade');

        // 2. Remove o visual de "Ativo" de todos eles
        todosBotoes.forEach(btn => {
            // Volta pro fundo cinza
            btn.classList.remove('bg-primary/10', 'border-primary', 'is-active');
            btn.classList.add('bg-gray-50', 'hover:bg-gray-100', 'border-transparent');

            // Volta o texto pro escuro
            const titulo = btn.querySelector('.titulo-atividade');
            if (titulo) {
                titulo.classList.remove('text-primary');
                titulo.classList.add('text-gray-800');
            }

            // Esconde o "✓"
            const check = btn.querySelector('.icon-check');
            if (check) {
                check.classList.add('hidden');
            }
        });

        // 3. Aplica o visual de "Ativo" APENAS no botão que foi clicado
        botaoAtivo.classList.remove('bg-gray-50', 'hover:bg-gray-100', 'border-transparent');
        botaoAtivo.classList.add('bg-primary/10', 'border-primary', 'is-active');

        const tituloAtivo = botaoAtivo.querySelector('.titulo-atividade');
        if (tituloAtivo) {
            tituloAtivo.classList.remove('text-gray-800');
            tituloAtivo.classList.add('text-primary');
        }

        const checkAtivo = botaoAtivo.querySelector('.icon-check');
        if (checkAtivo) {
            checkAtivo.classList.remove('hidden');
        }
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