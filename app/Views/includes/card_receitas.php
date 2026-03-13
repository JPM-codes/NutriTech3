<?php if (empty($recipes)): ?>
    <div class="col-span-full text-center py-8 text-gray-500">
        Nenhuma receita encontrada para esta categoria ou busca.
    </div>
<?php else: ?>
    <?php foreach ($recipes as $recipe): ?>
        <div class="recipe-card bg-white rounded-2xl overflow-hidden shadow-sm cursor-pointer" onclick="abrirModalReceita(<?= esc($recipe['id']) ?>)">

            <div class="relative h-40 overflow-hidden">
                <img src="<?= base_url('assets/img/recipes/' . esc($recipe['imagem'])) ?>"
                    alt="<?= esc($recipe['nome']) ?>"
                    class="recipe-image w-full h-full object-cover"
                    onerror="this.src='https://via.placeholder.com/400x200?text=Receita'">

                <div class="absolute top-2 right-2 px-2 py-1 bg-white/90 rounded-full text-xs font-medium">
                    <?= esc($recipe['dificuldade']) ?>
                </div>
            </div>

            <div class="p-4">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <span><?= esc($recipe['categoria'] ?? 'Sem categoria') ?></span>
                    <span>•</span>
                    <span>⏱️ <?= esc($recipe['tempo_preparo']) ?> min</span>
                </div>

                <h3 class="font-bold text-gray-800 mb-2"><?= esc($recipe['nome']) ?></h3>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 text-xs">
                        <span class="text-red-500">P: <?= esc($recipe['proteinas'] ?? 0) ?>g</span>
                        <span class="text-amber-500">C: <?= esc($recipe['carboidratos'] ?? 0) ?>g</span>
                        <span class="text-blue-500">G: <?= esc($recipe['gordura'] ?? 0) ?>g</span>
                    </div>
                    <span class="font-bold text-primary"><?= esc($recipe['calorias'] ?? 0) ?> kcal</span>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
<?php endif; ?>