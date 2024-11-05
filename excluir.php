<?php 
include "db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM tarefas WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Tarefa excluída com sucesso.";
    } else {
        echo "Erro ao excluir a tarefa: " . mysqli_error($conn);
    }
}

// Redireciona de volta 
header("Location: index.php");
exit;
?>