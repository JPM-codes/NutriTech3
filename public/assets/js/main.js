const AppState = {
    todayData: {
        calories: 0,
        protein: 0,
        carbs: 0,
        fat: 0,
        water: 0,
        meals: { breakfast: [], lunch: [], dinner: [], snack: [] }
    },
    foodDatabase: [],
    recipes: [],
    history: []
};

document.addEventListener('DOMContentLoaded', () => {
    initializeApp();
});

function initializeApp() {
    setupEventListeners();
    updateDateDisplay();
    
    setTimeout(() => {
        hideSplashScreen();
    }, 1000);
}

// ===== Dropdown do Usuário =====
function toggleUserMenu() {
    document.getElementById('user-dropdown').classList.toggle('hidden');
}

document.addEventListener('click', (e) => {
    const userMenu = document.getElementById('user-menu');
    const dropdown = document.getElementById('user-dropdown');
    if (userMenu && dropdown && !userMenu.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});


// ===== Event Listeners =====
function setupEventListeners() {
    const closeBtn = document.getElementById('close-modal');
    if (closeBtn) closeBtn.addEventListener('click', closeAddFoodModal);
    
    const addFoodModal = document.getElementById('add-food-modal');
    if (addFoodModal) {
        addFoodModal.addEventListener('click', (e) => {
            if (e.target.id === 'add-food-modal') closeAddFoodModal();
        });
    }

    const quickAddBtn = document.getElementById('quick-add-btn');
    if (quickAddBtn) quickAddBtn.addEventListener('click', openQuickAddModal);
    
    const closeQuickModalBtn = document.getElementById('close-quick-modal');
    if (closeQuickModalBtn) closeQuickModalBtn.addEventListener('click', closeQuickAddModal);
    
    const quickAddModal = document.getElementById('quick-add-modal');
    if (quickAddModal) {
        quickAddModal.addEventListener('click', (e) => {
            if (e.target.id === 'quick-add-modal') closeQuickAddModal();
        });
    }

    const quickAddForm = document.getElementById('quick-add-form');
    if (quickAddForm) quickAddForm.addEventListener('submit', handleQuickAdd);
    
    const foodSearch = document.getElementById('food-search');
    if (foodSearch) foodSearch.addEventListener('input', handleFoodSearch);

    document.querySelectorAll('.meal-type-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.meal-type-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
        });
    });
}

// ===== Funções de UI =====
function hideSplashScreen() {
    const splash = document.getElementById('splash-screen');
    const app = document.getElementById('app');
    if (splash && app) {
        splash.style.opacity = '0';
        setTimeout(() => { splash.style.display = 'none'; app.style.opacity = '1'; }, 500);
    }
}

function updateDateDisplay() {
    const dateEl = document.getElementById('current-date');
    if (dateEl) {
        const options = { weekday: 'long', day: 'numeric', month: 'long' };
        const today = new Date().toLocaleDateString('pt-BR', options);
        dateEl.textContent = today.charAt(0).toUpperCase() + today.slice(1);
    }
}

function showToast(message) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    if (!toast || !toastMessage) return;

    toastMessage.textContent = message;
    toast.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
    toast.classList.add('opacity-100', 'translate-y-0');
    setTimeout(() => {
        toast.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        toast.classList.remove('opacity-100', 'translate-y-0');
    }, 3000);
}

// ===== Modais de Comida =====
function openAddFoodModal() {
    const modal = document.getElementById('add-food-modal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        loadFoodList();
    }
}

function closeAddFoodModal() {
    const modal = document.getElementById('add-food-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        const searchInput = document.getElementById('food-search');
        if (searchInput) searchInput.value = '';
    }
}

function openQuickAddModal() {
    closeAddFoodModal();
    const modal = document.getElementById('quick-add-modal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeQuickAddModal() {
    const modal = document.getElementById('quick-add-modal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        const form = document.getElementById('quick-add-form');
        if (form) form.reset();
    }
}

function loadFoodList(searchTerm = '') {
    const foodList = document.getElementById('food-list');
    if (!foodList) return;

    let foods = AppState.foodDatabase;
    if (searchTerm) foods = foods.filter(f => f.name.toLowerCase().includes(searchTerm.toLowerCase()));
    
    foodList.innerHTML = foods.length > 0 ? foods.map(food => `
        <div class="food-card flex items-center justify-between p-3 bg-gray-50 rounded-xl mb-2 cursor-pointer hover:bg-gray-100 transition-colors" onclick="addFoodToMeal(${food.id})">
            <div class="flex items-center gap-3">
                <span class="text-2xl">${food.emoji}</span>
                <div>
                    <p class="font-medium text-gray-800">${food.name}</p>
                    <p class="text-xs text-gray-500">${food.portion}g • P: ${food.protein}g | C: ${food.carbs}g | G: ${food.fat}g</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-bold text-primary">${food.calories}</p>
                <p class="text-xs text-gray-500">kcal</p>
            </div>
        </div>
    `).join('') : '<div class="text-center py-8 text-gray-500"><p>Nenhum alimento encontrado</p></div>';
}

function handleFoodSearch(e) { loadFoodList(e.target.value); }

function addFoodToMeal(foodId) {
    const food = AppState.foodDatabase.find(f => f.id === foodId);
    const activeMealBtn = document.querySelector('.meal-type-btn.active');
    const activeMeal = activeMealBtn ? activeMealBtn.dataset.meal : 'snack';
    
    if (food) {
        AppState.todayData.meals[activeMeal].push({...food, addedAt: new Date().toISOString()});
        AppState.todayData.calories += food.calories;
        AppState.todayData.protein += food.protein;
        AppState.todayData.carbs += food.carbs;
        AppState.todayData.fat += food.fat;
        
        showToast(`${food.name} adicionado!`);
        closeAddFoodModal();
        
        if (typeof renderDashboard === 'function') renderDashboard();
    }
}

function handleQuickAdd(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const activeMealBtn = document.querySelector('.meal-type-btn.active');
    const activeMeal = activeMealBtn ? activeMealBtn.dataset.meal : 'snack';
    
    const food = {
        id: Date.now(),
        name: formData.get('name'),
        calories: parseInt(formData.get('calories')) || 0,
        protein: parseInt(formData.get('protein')) || 0,
        carbs: parseInt(formData.get('carbs')) || 0,
        fat: parseInt(formData.get('fat')) || 0,
        portion: parseInt(formData.get('portion')) || 100,
        emoji: '🍽️'
    };
    
    AppState.todayData.meals[activeMeal].push({...food, addedAt: new Date().toISOString()});
    AppState.todayData.calories += food.calories;
    AppState.todayData.protein += food.protein;
    AppState.todayData.carbs += food.carbs;
    AppState.todayData.fat += food.fat;
    
    showToast(`${food.name} adicionado!`);
    closeQuickAddModal();
    
    if (typeof renderDashboard === 'function') renderDashboard();
}

// ===== Utilitários =====
function formatNumber(num) { return new Intl.NumberFormat('pt-BR').format(num); }
function calculatePercentage(current, goal) { return Math.min(Math.round((current / goal) * 100), 100); }

// ===== Exportações =====
window.AppState = AppState;
window.showToast = showToast;
window.formatNumber = formatNumber;
window.calculatePercentage = calculatePercentage;
window.toggleUserMenu = toggleUserMenu;
window.addFoodToMeal = addFoodToMeal;
window.openAddFoodModal = openAddFoodModal;
window.closeAddFoodModal = closeAddFoodModal;
window.loadFoodList = loadFoodList;