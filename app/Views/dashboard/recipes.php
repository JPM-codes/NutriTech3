<div class="p-4 space-y-6 animate-fade-in">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Receitas Saudáveis</h2>
        <p class="text-gray-500">Encontre receitas nutritivas e deliciosas</p>
    </div>

    <div class="relative">
        <input type="text" id="recipe-search" placeholder="Buscar receitas..."
            class="w-full pl-10 pr-4 py-3 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/50"
            onkeyup="filterRecipes(this.value)">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
        <button class="category-btn ${currentCategory === 'all' ? 'active' : ''} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600"
            onclick="filterByCategory('all')">🍽️ Todas</button>
        <button class="category-btn ${currentCategory === 'Café da manhã' ? 'active' : ''} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600"
            onclick="filterByCategory('Café da manhã')">☀️ Café da Manhã</button>
        <button class="category-btn ${currentCategory === 'Almoço' ? 'active' : ''} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600"
            onclick="filterByCategory('Almoço')">🥗 Almoço</button>
        <button class="category-btn ${currentCategory === 'Jantar' ? 'active' : ''} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600"
            onclick="filterByCategory('Jantar')">🌙 Jantar</button>
        <button class="category-btn ${currentCategory === 'Lanche' ? 'active' : ''} whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all bg-gray-100 text-gray-600"
            onclick="filterByCategory('Lanche')">🍎 Lanches</button>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-primary to-secondary p-6 text-white">
        <div class="relative z-10">
            <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-medium">⭐ Receita do Dia</span>
            <h3 class="text-xl font-bold mt-3">Bowl de Açaí Proteico</h3>
            <p class="text-green-100 text-sm mt-1">Perfeito para começar o dia com energia!</p>
            <div class="flex items-center gap-4 mt-3 text-sm">
                <span>🔥 350 kcal</span>
                <span>⏱️ 10 min</span>
                <span>📊 Fácil</span>
            </div>
            <button class="mt-4 px-4 py-2 bg-white text-primary rounded-lg font-medium text-sm hover:bg-green-50 transition-colors"
                onclick="openRecipeDetail(1)">Ver Receita</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="recipes-grid">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card bg-white rounded-2xl overflow-hidden shadow-sm cursor-pointer" onclick="openRecipeDetail(<?= esc($recipe['id']) ?>)">

                <div class="relative h-40 overflow-hidden">
                    <img src="<?= esc($recipe['imagem'] ?? 'https://via.placeholder.com/400x200?text=Receita') ?>"
                        alt="<?= esc($recipe['name']) ?>"
                        class="recipe-image w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x200?text=Receita'">

                    <div class="absolute top-2 right-2 px-2 py-1 bg-white/90 rounded-full text-xs font-medium">
                        <?= esc($recipe['dificuldade']) ?>
                    </div>
                </div>

                <div class="p-4">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                        <span><?= esc($recipe['categoria_nome'] ?? 'Sem categoria') ?></span>
                        <span>•</span>
                        <span>⏱️ <?= esc($recipe['recipe_tempo_reparo']) ?> min</span>
                    </div>

                    <h3 class="font-bold text-gray-800 mb-2"><?= esc($recipe['recipe_nome']) ?></h3>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-xs">
                            <span class="text-red-500">P: <?= esc($recipe['protein'] ?? 0) ?>g</span>
                            <span class="text-amber-500">C: <?= esc($recipe['carbs'] ?? 0) ?>g</span>
                            <span class="text-blue-500">G: <?= esc($recipe['fat'] ?? 0) ?>g</span>
                        </div>
                        <span class="font-bold text-primary"><?= esc($recipe['calories'] ?? 0) ?> kcal</span>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="recipe-detail-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-lg max-h-[90vh] overflow-hidden animate-slide-up">
        <div id="recipe-detail-content"></div>
    </div>
</div>

<!-- Recipe Modal -->
<div id="recipe-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <div class="modal-image-container">
            <img id="modal-image" src="" alt="" class="modal-image">
            <button onclick="closeRecipeModal()" class="modal-close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="modal-category-badge" id="modal-category"></div>
        </div>
        <div class="modal-body">
            <h2 id="modal-title" class="modal-title"></h2>
            <div class="modal-stats" id="modal-stats"></div>
            <div class="modal-macros" id="modal-macros"></div>
            <div class="modal-section">
                <h3>🛒 Ingredientes</h3>
                <ul id="modal-ingredients" class="ingredients-list"></ul>
            </div>
            <div class="modal-section">
                <h3>👨‍🍳 Modo de Preparo</h3>
                <p id="modal-instructions" class="instructions-text"></p>
            </div>
            <button class="modal-add-btn" onclick="addToDaily()">
                + Adicionar ao Diário
            </button>
        </div>
    </div>
</div>

<script src="recipes.js"></script>
<script>
    // Recipe data
    const recipes = [{
            id: 1,
            name: 'Bowl de Açaí Proteico',
            image: 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=400',
            category: 'Café da manhã',
            calories: 350,
            time: 10,
            difficulty: 'Fácil',
            protein: 15,
            carbs: 45,
            fat: 12,
            ingredients: ['200g açaí', '1 banana', '30g granola', '1 scoop whey protein', 'Frutas a gosto'],
            instructions: 'Bata o açaí congelado com a banana no liquidificador. Transfira para uma tigela e cubra com granola, whey protein e frutas de sua preferência. Sirva imediatamente.'
        },
        {
            id: 2,
            name: 'Frango Grelhado com Legumes',
            image: 'https://images.unsplash.com/photo-1532550907401-a500c9a57435?w=400',
            category: 'Almoço',
            calories: 420,
            time: 30,
            difficulty: 'Médio',
            protein: 45,
            carbs: 20,
            fat: 18,
            ingredients: ['200g peito de frango', '100g brócolis', '100g cenoura', '50g abobrinha', 'Azeite e temperos'],
            instructions: 'Tempere o frango com sal, pimenta e ervas. Grelhe em fogo médio por 6-8 minutos de cada lado. Enquanto isso, asse os legumes com azeite a 200°C por 20 minutos.'
        },
        {
            id: 3,
            name: 'Overnight Oats',
            image: 'https://images.unsplash.com/photo-1517673400267-0251440c45dc?w=400',
            category: 'Café da manhã',
            calories: 280,
            time: 5,
            difficulty: 'Fácil',
            protein: 12,
            carbs: 40,
            fat: 8,
            ingredients: ['50g aveia', '200ml leite', '1 colher de mel', 'Frutas frescas', 'Sementes de chia'],
            instructions: 'Misture a aveia com o leite em um pote. Adicione mel e sementes de chia. Cubra e refrigere durante a noite. Pela manhã, adicione as frutas e sirva frio.'
        },
        {
            id: 4,
            name: 'Salada Caesar com Frango',
            image: 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=400',
            category: 'Almoço',
            calories: 380,
            time: 20,
            difficulty: 'Fácil',
            protein: 35,
            carbs: 15,
            fat: 22,
            ingredients: ['Alface romana', '150g frango grelhado', 'Croutons', 'Queijo parmesão', 'Molho caesar'],
            instructions: 'Lave e seque a alface. Grelhe o frango e corte em tiras. Monte a salada com alface, frango, croutons e queijo. Finalize com o molho caesar.'
        },
        {
            id: 5,
            name: 'Smoothie Verde Detox',
            image: 'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=400',
            category: 'Lanche',
            calories: 150,
            time: 5,
            difficulty: 'Fácil',
            protein: 3,
            carbs: 30,
            fat: 2,
            ingredients: ['1 xícara de espinafre', '1 maçã verde', '1 pedaço de gengibre', '200ml água de coco', 'Gelo'],
            instructions: 'Adicione todos os ingredientes no liquidificador e bata até ficar homogêneo. Sirva imediatamente com gelo.'
        },
        {
            id: 6,
            name: 'Salmão ao Forno',
            image: 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=400',
            category: 'Jantar',
            calories: 450,
            time: 25,
            difficulty: 'Médio',
            protein: 40,
            carbs: 5,
            fat: 30,
            ingredients: ['200g filé de salmão', '1 limão', 'Ervas finas', 'Azeite de oliva', 'Sal e pimenta'],
            instructions: 'Tempere o salmão com sal, pimenta, suco de limão e ervas. Regue com azeite. Asse em forno pré-aquecido a 200°C por 20 minutos ou até dourar.'
        }
    ];

    function openRecipeModal(id) {
        const recipe = recipes.find(r => r.id === id);
        if (!recipe) return;

        document.getElementById('modal-image').src = recipe.image;
        document.getElementById('modal-title').textContent = recipe.name;
        document.getElementById('modal-category').textContent = recipe.category;
        document.getElementById('modal-stats').innerHTML = `
                <span>🔥 ${recipe.calories} kcal</span>
                <span>⏱️ ${recipe.time} min</span>
                <span>📊 ${recipe.difficulty}</span>
            `;
        document.getElementById('modal-macros').innerHTML = `
                <div class="macro-box protein"><p class="macro-value">${recipe.protein}g</p><p class="macro-label">Proteína</p></div>
                <div class="macro-box carbs"><p class="macro-value">${recipe.carbs}g</p><p class="macro-label">Carboidratos</p></div>
                <div class="macro-box fat"><p class="macro-value">${recipe.fat}g</p><p class="macro-label">Gordura</p></div>
            `;
        document.getElementById('modal-ingredients').innerHTML = recipe.ingredients.map(ing => `<li>${ing}</li>`).join('');
        document.getElementById('modal-instructions').textContent = recipe.instructions;

        document.getElementById('recipe-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeRecipeModal() {
        document.getElementById('recipe-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function addToDaily() {
        alert('Receita adicionada ao diário!');
        closeRecipeModal();
    }

    // Category filter
    document.querySelectorAll('.category-chip').forEach(chip => {
        chip.addEventListener('click', () => {
            document.querySelectorAll('.category-chip').forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
        });
    });

    // Quick filters
    document.querySelectorAll('.quick-filter').forEach(filter => {
        filter.addEventListener('click', () => {
            filter.classList.toggle('active');
        });
    });
</script>