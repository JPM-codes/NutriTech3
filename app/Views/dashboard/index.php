<?php
$userId = session('id');

$macros = macros_hoje($userId);
$goals = metas_macros($userId);
$goal = meta_calorias_diaria($userId);
$consumed = calorias_hoje($userId);
$remaining = calorias_restantes($userId);
$percentage = percentual_calorias($userId);

$circumference = 2 * pi() * 52;
$offset = $circumference * (1 - ($percentage / 100));
?>

<!-- Splash Screen -->
<div id="splash-screen" class="fixed inset-0 bg-gradient-to-br from-primary to-secondary flex items-center justify-center z-50 transition-opacity duration-500">
    <div class="text-center">
        <div class="animate-bounce-slow">
            <svg class="w-24 h-24 mx-auto text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
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
    <!-- Main Content -->
    <main id="main-content" class="pb-20">
        <div class="p-4 space-y-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Olá, <?= esc(user()['name']) ?>👋</h2>
                    <p class="text-gray-500 text-sm">Acompanhe seu progresso de hoje</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Calorias de Hoje</h3>

                        <p class="text-sm text-gray-500 mb-4">
                            <?= $remaining > 0 ? 'Restam' : 'Excedeu' ?>
                            <span class="font-bold <?= $remaining > 0 ? 'text-primary' : 'text-red-500' ?>">
                                <?= abs($remaining) ?> kcal
                            </span>
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Meta diária <span class="font-medium"><?= formatar_numero($goal) ?> kcal</span></span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">
                                    Consumido
                                    <span class="font-medium text-primary">
                                        <?= formatar_numero($consumed) ?> kcal
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-32 h-32">
                        <svg class="w-full h-full progress-ring" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="#e5e7eb" stroke-width="12" />
                            <circle cx="60" cy="60" r="52" fill="none" stroke="url(#gradient)" stroke-width="12"
                                stroke-dasharray="<?= $circumference ?>"
                                stroke-dashoffset="<?= $offset ?>"
                                stroke-linecap="round" class="progress-ring__circle" />
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#22c55e" />
                                    <stop offset="100%" stop-color="#16a34a" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-bold text-gray-800">
                                <?= $percentage ?>%
                            </span>
                            <span class="text-xs text-gray-500">completo</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center"><span class="text-sm">🥩</span></div>
                        <span class="text-sm font-medium text-gray-700">Proteína</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800"><?= $macros['proteinas'] ?>g</p>
                    <p class="text-xs text-gray-500 mt-1"><?= $goals['proteinas'] ?>g meta</p>

                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2 overflow-hidden">

                        <div class="h-full bg-red-400 rounded-full macro-bar"
                            style="width: <?= min(100, round(floatval(str_replace(',', '.', percentual_macro($macros['proteinas'], $goals['proteinas']))))) ?>%">
                        </div>

                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center"><span class="text-sm">🍞</span></div>
                        <span class="text-sm font-medium text-gray-700">Carbos</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800"><?= $macros['carboidratos'] ?>g</p>
                    <p class="text-xs text-gray-500 mt-1"><?= $goals['carboidratos'] ?>g meta</p>

                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2 overflow-hidden">

                        <div class="h-full bg-amber-400 rounded-full macro-bar"
                            style="width: <?= min(100, round(floatval(str_replace(',', '.', percentual_macro($macros['carboidratos'], $goals['carboidratos']))))) ?>%">
                        </div>

                    </div>

                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center"><span class="text-sm">🥑</span></div>
                        <span class="text-sm font-medium text-gray-700">Gordura</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800"><?= $macros['gorduras'] ?>g</p>
                    <p class="text-xs text-gray-500 mt-1"><?= $goals['gorduras'] ?>g meta</p>

                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2 overflow-hidden">

                        <div class="h-full bg-blue-400 rounded-full macro-bar"
                            style="width: <?= min(100, round(floatval(str_replace(',', '.', percentual_macro($macros['gorduras'], $goals['gorduras']))))) ?>%">
                        </div>

                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm">

                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">Água 💧</h3>
                    <span class="text-sm text-gray-500">
                        <span id="water-count"><?= $water ?></span>/8 copos
                    </span>
                </div>

                <div class="flex items-center justify-between gap-2" id="water-tracker">

                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <button
                            class="water-drop text-3xl transition-all <?= $i <= $water ? 'filled' : '' ?>"
                            onclick="updateWater(<?= $i ?>)">
                            💧
                        </button>
                    <?php endfor; ?>

                </div>

            </div>

            <div class="space-y-3">
                <h3 class="font-semibold text-gray-800">Refeições de Hoje</h3>
                <?= renderizar_secao_refeicao('cafe', '☀️ Café da Manhã', $todayData['cafe']) ?>
                <?= renderizar_secao_refeicao('almoco', '🍽️ Almoço', $todayData['almoco']) ?>
                <?= renderizar_secao_refeicao('jantar', '🌙 Jantar', $todayData['jantar']) ?>
                <?= renderizar_secao_refeicao('lanche', '🍎 Lanches', $todayData['lanche']) ?>

            </div>

            <div class="bg-gradient-to-br from            <div class=" bg-gradient-to-br from-primary/10 to-secondary/10 rounded-2xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-xl">💡</div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Dica do Dia</h4>
                        <p id="tip" class="text-sm text-gray-600 mt-1"></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Add Food Modal (usado pelos botões + nas refeições) -->
<div id="add-food-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md max-h-[90vh] overflow-hidden animate-slide-up">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Adicionar Alimento</h2>
            <button id="close-modal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4">
            <div class="relative mb-4">
                <input type="text" id="food-search" placeholder="Buscar alimento..." class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="max-h-60 overflow-y-auto" id="food-list">
                <?php if (!empty($alimentos)): ?>
                    <?php foreach ($alimentos as $alimento): ?>
                        <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" class="form-adicionar-alimento">

                            <input type="hidden" name="alimento_id" value="<?= $alimento['id'] ?>">
                            <input type="hidden" name="tipo_refeicao" class="input-refeicao" value="">

                            <div class="food-item flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl border-b border-gray-100 transition-colors">
                                <div>
                                    <h4 class="food-name text-sm font-semibold text-gray-800">
                                        <?= htmlspecialchars($alimento['nome']) ?>
                                    </h4>

                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="font-medium text-gray-700"><?= $alimento['calorias'] ?> kcal</span> •
                                        P: <?= $alimento['proteinas'] ?>g •
                                        C: <?= $alimento['carboidratos'] ?>g •
                                        G: <?= $alimento['gorduras'] ?>g
                                    </p>
                                </div>

                                <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-full transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 py-4 text-sm">Nenhum alimento encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed top-20 left-1/2 -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-xl shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300 transform -translate-y-2">
    <span id="toast-message"></span>
</div>

<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
<script>
    // Chama a função para exibir a dica assim que a página for carregada
    window.onload = function() {
        const tip = getRandomTip(); // Chama a função de dica aleatória
        document.getElementById('tip').textContent = tip; // Exibe a dica no parágrafo
    };
</script>