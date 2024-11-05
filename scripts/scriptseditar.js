function abrirModalEdicao(tarefa) {
    document.getElementById('id_tarefa').value = tarefa.id;
    document.getElementById('nome_tarefa').value = tarefa.nome_tarefa;
    document.getElementById('custo').value = tarefa.custo;
    document.getElementById('data_limite').value = tarefa.data_limite;

    const modal = document.getElementById('modalEdicao');
    modal.style.display = "block"; // Exibe o modal
}

// Função para fechar o modal
function fecharModalEdicao() {
    const modal = document.getElementById('modalEdicao');
    modal.style.display = "none"; // Esconde o modal
}

//fechar o modal ao clicar fora dele
window.onclick = function (event) {
    const modal = document.getElementById('modalEdicao');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
