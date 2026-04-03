
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

// 1. Evento APENAS para fechar o menu de usuário (Click)
document.addEventListener('click', (e) => {
    const userMenu = document.getElementById('user-menu');
    const dropdown = document.getElementById('user-dropdown');

    // Se o menu existe e o clique foi fora dele, esconde o menu
    if (userMenu && dropdown && !userMenu.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});


// 2. Controla os cliques na tela (Abrir/Fechar Modal e Menu)
document.addEventListener('click', (e) => {

    // -- Lógica para ABRIR o modal --
    // Certifique-se de que seus botões na tela principal tenham a classe 'btn-abrir-modal' e o atributo 'data-refeicao'
    const btnAbrir = e.target.closest('.btn-abrir-modal');
    if (btnAbrir) {
        // Salva a refeição (ex: 'cafe', 'almoco') do botão que foi clicado
        refeicaoSelecionada = btnAbrir.getAttribute('data-refeicao');

        const modal = document.getElementById('add-food-modal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    // -- Lógica para FECHAR o modal --
    const btnFechar = e.target.closest('#close-modal');
    if (btnFechar) {
        const modal = document.getElementById('add-food-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // -- Lógica do Menu do Usuário (mantida para não quebrar seu layout) --
    const userMenu = document.getElementById('user-menu');
    const dropdown = document.getElementById('user-dropdown');
    if (userMenu && dropdown && !userMenu.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});

// 3. Controla o envio do formulário (Adicionar o alimento)
document.addEventListener('submit', async function (e) {

    // Verifica se o submit veio de dentro da sua div exata
    if (e.target && e.target.classList.contains('form-adicionar-alimento')) {
        e.preventDefault();

        // Impede que o envio seja duplicado
        e.stopImmediatePropagation();

        const form = e.target;
        const submitBtn = form.querySelector('button[type="submit"]');

        const formData = new FormData(form);
        const url = form.getAttribute('action');

        // Adicione esta linha para investigar:
        console.log("A refeição que está sendo enviada é:", formData.get('tipo_refeicao'));

        if (submitBtn) submitBtn.disabled = true;

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);

                if (typeof renderDashboard === 'function') renderDashboard();

            } else {
                alert('Erro: ' + result.error);
            }

        } catch (error) {
            console.error('Erro na requisição:', error);
            alert('Falha na conexão com o servidor.');
        } finally {
            if (submitBtn) submitBtn.disabled = false;
        }
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
function openAddFoodModal(tipoRefeicao) {
    const modal = document.getElementById('add-food-modal');

    if (modal) {
        // 1. Procura todos os inputs com a classe 'input-refeicao' dentro do modal
        const inputsRefeicao = modal.querySelectorAll('.input-refeicao');

        // 2. Altera o 'value' de todos eles para a refeição que foi clicada
        inputsRefeicao.forEach(input => {
            input.value = tipoRefeicao;
        });

        // 3. Abre o modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
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
function handleFoodSearch(e) { loadFoodList(e.target.value); }

function addFoodToMeal(foodId) {
    const food = AppState.foodDatabase.find(f => f.id === foodId);
    const activeMealBtn = document.querySelector('.meal-type-btn.active');
    const activeMeal = activeMealBtn ? activeMealBtn.dataset.meal : 'snack';

    if (food) {
        AppState.todayData.meals[activeMeal].push({ ...food, addedAt: new Date().toISOString() });
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

    AppState.todayData.meals[activeMeal].push({ ...food, addedAt: new Date().toISOString() });
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

window.showToast = showToast;
window.formatNumber = formatNumber;
window.calculatePercentage = calculatePercentage;
window.toggleUserMenu = toggleUserMenu;
window.addFoodToMeal = addFoodToMeal;
window.openAddFoodModal = openAddFoodModal;
window.closeAddFoodModal = closeAddFoodModal;