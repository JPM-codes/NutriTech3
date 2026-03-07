// ===== Profile Module =====

function renderProfile() {
    const { user } = AppState;
    const bmi = calculateBMI(user.currentWeight, user.height);
    const bmiCategory = getBMICategory(bmi);
    
    return `
        <div class="p-4 space-y-6 animate-fade-in">
            <!-- Profile Header -->
            <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl p-6 text-white">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-3xl font-bold text-primary">
                        ${user.name.charAt(0)}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">${user.name}</h2>
                        <p class="text-green-100">${user.email}</p>
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
                    <p class="text-2xl font-bold text-gray-800">${user.currentWeight} <span class="text-sm font-normal">kg</span></p>
                </div>
                <div class="bg-white rounded-2xl p-4 shadow-sm border-2 border-primary/20">
                    <p class="text-sm text-gray-500">Meta de Peso</p>
                    <p class="text-2xl font-bold text-primary">${user.targetWeight} <span class="text-sm font-normal">kg</span></p>
                </div>
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Altura</p>
                    <p class="text-2xl font-bold text-gray-800">${user.height} <span class="text-sm font-normal">cm</span></p>
                </div>
                <div class="bg-white rounded-2xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">IMC</p>
                    <p class="text-2xl font-bold ${bmiCategory.color}">${bmi.toFixed(1)}</p>
                    <p class="text-xs text-gray-400">${bmiCategory.label}</p>
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
                        <p class="text-3xl font-bold text-gray-800">${formatNumber(user.dailyCalorieGoal)}</p>
                        <p class="text-sm text-gray-500">calorias por dia</p>
                    </div>
                </div>
            </div>

            <!-- Activity Level -->
            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-4">Nível de Atividade</h3>
                <div class="space-y-2">
                    ${renderActivityOption('sedentary', 'Sedentário', 'Pouco ou nenhum exercício', '🛋️')}
                    ${renderActivityOption('light', 'Levemente Ativo', 'Exercício leve 1-3 dias/semana', '🚶')}
                    ${renderActivityOption('moderate', 'Moderadamente Ativo', 'Exercício moderado 3-5 dias/semana', '🏃')}
                    ${renderActivityOption('active', 'Muito Ativo', 'Exercício intenso 6-7 dias/semana', '💪')}
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <h3 class="font-semibold text-gray-800 p-4 border-b border-gray-100">Configurações</h3>
                
                <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🔔</span>
                        <div class="text-left">
                            <p class="font-medium text-gray-800">Notificações</p>
                            <p class="text-xs text-gray-500">Lembretes de refeições e água</p>
                        </div>
                    </div>
                    <div class="w-12 h-6 bg-primary rounded-full relative">
                        <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full shadow"></div>
                    </div>
                </button>
                
                <button onclick="exportData()" class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">📤</span>
                        <div class="text-left">
                            <p class="font-medium text-gray-800">Exportar Dados</p>
                            <p class="text-xs text-gray-500">Baixar histórico em JSON</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- LOGOUT BUTTON -->
                <button onclick="logout()" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🚪</span>
                        <div class="text-left">
                            <p class="font-medium text-red-600">Sair da Conta</p>
                            <p class="text-xs text-red-400">Encerrar sessão atual</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
                
                <button onclick="resetData()" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🗑️</span>
                        <div class="text-left">
                            <p class="font-medium text-red-600">Resetar Dados</p>
                            <p class="text-xs text-red-400">Apagar todo o histórico</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <form id="edit-profile-form" onsubmit="saveProfile(event)" class="p-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="name" value="${user.name}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="${user.email}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Peso Atual (kg)</label>
                            <input type="number" name="currentWeight" value="${user.currentWeight}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta de Peso (kg)</label>
                            <input type="number" name="targetWeight" value="${user.targetWeight}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Altura (cm)</label>
                            <input type="number" name="height" value="${user.height}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Idade</label>
                            <input type="number" name="age" value="${user.age}" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium hover:opacity-90 transition-opacity">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="p-4 space-y-4">
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 mb-2">Meta diária de calorias</p>
                        <input type="number" id="calorie-goal-input" value="${user.dailyCalorieGoal}" class="text-4xl font-bold text-center text-gray-800 bg-transparent w-32 focus:outline-none">
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
    `;
}

function renderActivityOption(value, title, description, emoji) {
    const isActive = AppState.user.activityLevel === value;
    return `
        <button onclick="setActivityLevel('${value}')" 
                class="w-full flex items-center gap-3 p-3 rounded-xl transition-colors ${isActive ? 'bg-primary/10 border-2 border-primary' : 'bg-gray-50 hover:bg-gray-100 border-2 border-transparent'}">
            <span class="text-2xl">${emoji}</span>
            <div class="text-left flex-1">
                <p class="font-medium ${isActive ? 'text-primary' : 'text-gray-800'}">${title}</p>
                <p class="text-xs text-gray-500">${description}</p>
            </div>
            ${isActive ? '<span class="text-primary">✓</span>' : ''}
        </button>
    `;
}

function initProfile() {}

function calculateBMI(weight, height) {
    const heightInMeters = height / 100;
    return weight / (heightInMeters * heightInMeters);
}

function getBMICategory(bmi) {
    if (bmi < 18.5) return { label: 'Abaixo do peso', color: 'text-blue-500' };
    if (bmi < 25) return { label: 'Peso normal', color: 'text-green-500' };
    if (bmi < 30) return { label: 'Sobrepeso', color: 'text-yellow-500' };
    return { label: 'Obesidade', color: 'text-red-500' };
}

function calculateSuggestedCalories(goal) {
    const { currentWeight, height, age, activityLevel } = AppState.user;
    const bmr = 10 * currentWeight + 6.25 * height - 5 * age + 5;
    const activityMultipliers = { sedentary: 1.2, light: 1.375, moderate: 1.55, active: 1.725 };
    const tdee = bmr * (activityMultipliers[activityLevel] || 1.55);
    
    switch(goal) {
        case 'lose': return Math.round(tdee - 500);
        case 'gain': return Math.round(tdee + 300);
        default: return Math.round(tdee);
    }
}

function openEditProfile() {
    document.getElementById('edit-profile-modal').classList.remove('hidden');
    document.getElementById('edit-profile-modal').classList.add('flex');
}

function closeEditProfile() {
    document.getElementById('edit-profile-modal').classList.add('hidden');
    document.getElementById('edit-profile-modal').classList.remove('flex');
}

function saveProfile(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    AppState.user.name = formData.get('name');
    AppState.user.email = formData.get('email');
    AppState.user.currentWeight = parseFloat(formData.get('currentWeight'));
    AppState.user.targetWeight = parseFloat(formData.get('targetWeight'));
    AppState.user.height = parseFloat(formData.get('height'));
    AppState.user.age = parseInt(formData.get('age'));
    
    saveAppData();
    closeEditProfile();
    loadPage('profile');
    showToast('Perfil atualizado!');
}

function openCalorieGoalModal() {
    document.getElementById('calorie-goal-modal').classList.remove('hidden');
    document.getElementById('calorie-goal-modal').classList.add('flex');
}

function closeCalorieGoalModal() {
    document.getElementById('calorie-goal-modal').classList.add('hidden');
    document.getElementById('calorie-goal-modal').classList.remove('flex');
}

function setCalorieGoal(value) {
    document.getElementById('calorie-goal-input').value = value;
}

function saveCalorieGoal() {
    const newGoal = parseInt(document.getElementById('calorie-goal-input').value);
    if (newGoal > 0) {
        AppState.user.dailyCalorieGoal = newGoal;
        saveAppData();
        closeCalorieGoalModal();
        loadPage('profile');
        showToast('Meta calórica atualizada!');
    }
}

function setActivityLevel(level) {
    AppState.user.activityLevel = level;
    AppState.user.dailyCalorieGoal = calculateSuggestedCalories('maintain');
    saveAppData();
    loadPage('profile');
    showToast('Nível de atividade atualizado!');
}

function exportData() {
    const data = { user: AppState.user, todayData: AppState.todayData, history: AppState.history, exportDate: new Date().toISOString() };
    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `nutritech_export_${new Date().toISOString().split('T')[0]}.json`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    showToast('Dados exportados com sucesso!');
}

function resetData() {
    if (confirm('Tem certeza que deseja apagar todos os dados? Esta ação não pode ser desfeita.')) {
        localStorage.removeItem('nutritech_data');
        location.reload();
    }
}

window.renderProfile = renderProfile;
window.initProfile = initProfile;
window.openEditProfile = openEditProfile;
window.closeEditProfile = closeEditProfile;
window.saveProfile = saveProfile;
window.openCalorieGoalModal = openCalorieGoalModal;
window.closeCalorieGoalModal = closeCalorieGoalModal;
window.setCalorieGoal = setCalorieGoal;
window.saveCalorieGoal = saveCalorieGoal;
window.setActivityLevel = setActivityLevel;
window.exportData = exportData;
window.resetData = resetData;