
function addToDaily() {
    // Pegamos o ID da receita que deve estar guardado em algum lugar do modal
    const receitaId = document.getElementById('modal-recipe-id').value;
    const tipoRefeicao = 'almoço'; // Você pode pegar isso de um <select> no modal

    fetch('/receitas/adicionar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({
            receita_id: receitaId,
            tipo_refeicao: tipoRefeicao
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) alert('Adicionado com sucesso!');
        });
}