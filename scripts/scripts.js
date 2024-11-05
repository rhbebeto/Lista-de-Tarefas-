function confirmarExclusao(id) {
    const modal = document.getElementById('modalConfirmacao');
    modal.style.display = 'block'; // Mostra o modal de confirmação

    const confirmarBtn = document.getElementById('confirmarBtn');
    confirmarBtn.onclick = function () {
        // Lógica para excluir a tarefa
        window.location.href = `excluir.php?id=${id}`; // Redireciona para o script de exclusão
    }
}