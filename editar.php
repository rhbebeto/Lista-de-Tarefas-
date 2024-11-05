<?php 
include "db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tarefa = $_POST['id_tarefa'];
    $nome_tarefa = $_POST['nome_tarefa'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];

    $query = "UPDATE tarefas SET nome_tarefa = '$nome_tarefa', custo = $custo, data_limite = '$data_limite' WHERE id = $id_tarefa";

    if (mysqli_query($conn, $query)) {
        echo "Tarefa atualizada com sucesso!";
        header("Location: index.php"); // Redireciona de volta para a lista de tarefas
        exit();
    } else {
        echo "Erro ao atualizar tarefa: " . mysqli_error($conn);
    }
} else {
    echo "Método de requisição inválido.";
}
?>