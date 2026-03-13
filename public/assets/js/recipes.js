// ===== Recipes Module =====

let currentCategory = 'all';
let searchTerm = '';

function renderRecipes() {
    return `
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
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
                ${renderRecipeCards()}
            </div>
        </div>

        <div id="recipe-detail-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg max-h-[90vh] overflow-hidden animate-slide-up">
                <div id="recipe-detail-content"></div>
            </div>
        </div>
    `;
}

function renderRecipeCards() {
    let filteredRecipes = AppState.recipes;
    
    if (currentCategory !== 'all') {
        filteredRecipes = filteredRecipes.filter(r => r.category === currentCategory);
    }
    
    if (searchTerm) {
        filteredRecipes = filteredRecipes.filter(r => 
            r.name.toLowerCase().includes(searchTerm.toLowerCase())
        );
    }
    
    if (filteredRecipes.length === 0) {
        return `<div class="col-span-full text-center py-12"><span class="text-4xl">🍳</span><p class="text-gray-500 mt-2">Nenhuma receita encontrada</p></div>`;
    }
    
    return filteredRecipes.map(recipe => `
        <div class="recipe-card bg-white rounded-2xl overflow-hidden shadow-sm cursor-pointer" onclick="openRecipeDetail(${recipe.id})">
            <div class="relative h-40 overflow-hidden">
                <img src="${recipe.image}" alt="${recipe.name}" class="recipe-image w-full h-full object-cover"
                     onerror="this.src='https://via.placeholder.com/400x200?text=Receita'">
                <div class="absolute top-2 right-2 px-2 py-1 bg-white/90 rounded-full text-xs font-medium">${recipe.difficulty}</div>
            </div>
            <div class="p-4">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2">
                    <span>${recipe.category}</span>
                    <span>•</span>
                    <span>⏱️ ${recipe.time} min</span>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">${recipe.name}</h3>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 text-xs">
                        <span class="text-red-500">P: ${recipe.protein}g</span>
                        <span class="text-amber-500">C: ${recipe.carbs}g</span>
                        <span class="text-blue-500">G: ${recipe.fat}g</span>
                    </div>
                    <span class="font-bold text-primary">${recipe.calories} kcal</span>
                </div>
            </div>
        </div>
    `).join('');
}

function initRecipes() {
    const style = document.createElement('style');
    style.textContent = `
        .category-btn.active { background-color: #22c55e !important; color: white !important; }
        .category-btn:hover:not(.active) { background-color: #e5e7eb; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    `;
    document.head.appendChild(style);
}

function openRecipeDetail(recipeId) {
    const recipe = AppState.recipes.find(r => r.id === recipeId);
    if (!recipe) return;
    
    const modal = document.getElementById('recipe-detail-modal');
    const content = document.getElementById('recipe-detail-content');
    
    content.innerHTML = `
        <div class="relative">
            <img src="${recipe.image}" alt="${recipe.name}" class="w-full h-48 object-cover"
                 onerror="this.src='https://via.placeholder.com/400x200?text=Receita'">
            <button onclick="closeRecipeDetail()" class="absolute top-4 right-4 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                <span class="px-2 py-1 bg-primary text-white rounded-full text-xs">${recipe.category}</span>
            </div>
        </div>
        
        <div class="p-4 max-h-[60vh] overflow-y-auto">
            <h2 class="text-xl font-bold text-gray-800">${recipe.name}</h2>
            
            <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
                <span>🔥 ${recipe.calories} kcal</span>
                <span>⏱️ ${recipe.time} min</span>
                <span>📊 ${recipe.difficulty}</span>
            </div>
            
            <div class="grid grid-cols-3 gap-3 mt-4">
                <div class="bg-red-50 rounded-lg p-3 text-center">
                    <p class="text-lg font-bold text-red-600">${recipe.protein}g</p>
                    <p class="text-xs text-red-500">Proteína</p>
                </div>
                <div class="bg-amber-50 rounded-lg p-3 text-center">
                    <p class="text-lg font-bold text-amber-600">${recipe.carbs}g</p>
                    <p class="text-xs text-amber-500">Carboidratos</p>
                </div>
                <div class="bg-blue-50 rounded-lg p-3 text-center">
                    <p class="text-lg font-bold text-blue-600">${recipe.fat}g</p>
                    <p class="text-xs text-blue-500">Gordura</p>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="font-semibold text-gray-800 mb-3">🛒 Ingredientes</h3>
                <ul class="space-y-2">
                    ${recipe.ingredients.map(ing => `
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-primary rounded-full"></span>
                            ${ing}
                        </li>
                    `).join('')}
                </ul>
            </div>
            
            <div class="mt-6">
                <h3 class="font-semibold text-gray-800 mb-3">👨‍🍳 Modo de Preparo</h3>
                <p class="text-gray-600 leading-relaxed">${recipe.instructions}</p>
            </div>
            
            <button onclick="addRecipeToMeal(${recipe.id})" 
                    class="w-full mt-6 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium hover:opacity-90 transition-opacity">
                + Adicionar ao Diário
            </button>
        </div>
    `;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeRecipeDetail() {
    const modal = document.getElementById('recipe-detail-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function addRecipeToMeal(recipeId) {
    const recipe = AppState.recipes.find(r => r.id === recipeId);
    if (!recipe) return;
    
    const food = {
        id: Date.now(),
        name: recipe.name,
        calories: recipe.calories,
        protein: recipe.protein,
        carbs: recipe.carbs,
        fat: recipe.fat,
        portion: 1,
        emoji: '🍽️',
        addedAt: new Date().toISOString()
    };
    
    const hour = new Date().getHours();
    let mealType = 'snack';
    if (hour >= 6 && hour < 11) mealType = 'breakfast';
    else if (hour >= 11 && hour < 15) mealType = 'lunch';
    else if (hour >= 18 && hour < 22) mealType = 'dinner';
    
    AppState.todayData.meals[mealType].push(food);
    AppState.todayData.calories += food.calories;
    AppState.todayData.protein += food.protein;
    AppState.todayData.carbs += food.carbs;
    AppState.todayData.fat += food.fat;
    
    saveAppData();
    closeRecipeDetail();
    showToast(`${recipe.name} adicionado!`);
}

window.renderRecipes = renderRecipes;
window.initRecipes = initRecipes;
window.filterByCategory = filterByCategory;
window.filterRecipes = filterRecipes;
window.openRecipeDetail = openRecipeDetail;
window.closeRecipeDetail = closeRecipeDetail;
window.addRecipeToMeal = addRecipeToMeal;