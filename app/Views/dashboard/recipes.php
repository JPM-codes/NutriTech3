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
    // Função para abrir o modal e carregar os dados
    async function abrirModalReceita(receitaId) {
        try {
            // Mostra o modal (opcionalmente pode mostrar um "Carregando..." aqui)
            document.getElementById('recipe-modal').classList.remove('hidden');

            // Faz a requisição para o controller do CodeIgniter
            const response = await fetch(`<?= base_url('dashboard/receitas/detalhes/') ?>${receitaId}`);
            const data = await response.json();

            if (data.erro) {
                alert(data.erro);
                return;
            }

            console.log("DADOS QUE VIERAM DO PHP:", data);


            // Preenche o Cabeçalho e Imagem
            document.getElementById('modal-title').innerText = data.nome;
            document.getElementById('modal-category').innerText = data.categoria;
            document.getElementById('modal-image').src = `<?=  base_url('assets/img/recipes/')?>${data.imagem}`; // Ajuste o caminho da imagem conforme seu projeto
            document.getElementById('modal-instructions').innerText = data.descricao;

            // Preenche as Estatísticas (Tempo e Porções)
            document.getElementById('modal-stats').innerHTML = `
            <span>⏱️ ${data.tempo_preparo} min</span> | 
            <span>🍽️ ${data.porcoes} porções</span>
        `;

            // Preenche os Macros (calculados no RecipeModel)
            document.getElementById('modal-macros').innerHTML = `
            <span class="macro-badge">🔥 ${data.calorias} kcal</span>
            <span class="macro-badge">🥩 ${data.proteinas}g Prot</span>
            <span class="macro-badge">🍞 ${data.carboidratos}g Carb</span>
            <span class="macro-badge">🥑 ${data.gordura}g Gord</span>
        `;

            // Limpa e Preenche a Lista de Ingredientes
            const listaIngredientes = document.getElementById('modal-ingredients');
            listaIngredientes.innerHTML = ''; // Limpa a lista antes de adicionar

            data.lista_ingredientes.forEach(ing => {
                const li = document.createElement('li');
                // Vai imprimir algo como: "200 g de Frango"
                li.innerText = `${ing.quantidade} ${ing.unidade} de ${ing.alimento}`;
                listaIngredientes.appendChild(li);
            });

            // Configura o botão de Adicionar ao Diário com o ID da receita atual
            const addBtn = document.querySelector('.modal-add-btn');
            addBtn.setAttribute('onclick', `addToDaily(${data.id})`);

        } catch (error) {
            console.error("Erro ao buscar a receita:", error);
        }
    }

    // Função que você já chamou no botão de fechar do seu HTML
    function closeRecipeModal() {
        document.getElementById('recipe-modal').classList.add('hidden');
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