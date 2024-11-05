<?php 
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca
    $query = "SELECT * FROM tarefas WHERE id = $id";
    $resultado = mysqli_query($conn, $query);
    
    // foi encontrada
    if (mysqli_num_rows($resultado) == 0) {
        echo "Tarefa não encontrada.";
        exit();
    }

    $tarefa = mysqli_fetch_assoc($resultado);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_tarefa = $_POST['nome_tarefa'];
        $custo = $_POST['custo'];
        $data_limite = $_POST['data_limite'];

        //se já existe uma tarefa com o mesmo nome
        $verifica_nome = "SELECT * FROM tarefas WHERE nome_tarefa = '$nome_tarefa' AND id != $id";
        $resultado_verifica = mysqli_query($conn, $verifica_nome);

        if (mysqli_num_rows($resultado_verifica) > 0) {
            echo "Erro: já existe uma tarefa com esse nome.";
        } else {
            // Atualiza
            $sql = "UPDATE tarefas SET nome_tarefa = '$nome_tarefa', custo = '$custo', data_limite = '$data_limite' WHERE id = $id";

            if (mysqli_query($conn, $sql)) {
                echo "Tarefa Atualizada";
                header("Location: index.php"); // Corrigido para remover o espaço
                exit();
            } else {
                echo "Erro: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "ID inválido";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <h1>Editar Tarefa</h1>
    <label for="nome">Altere:</label>
    <form action="" method="POST">
        <label for="nome">Nome da Tarefa:</label>
        <input type="text" id="nome_tarefa" name="nome_tarefa"
            value="<?php echo htmlspecialchars($tarefa['nome_tarefa']); ?>" required>

        <label for="custo">Custo:</label>
        <input type="number" id="custo" name="custo" value="<?php echo htmlspecialchars($tarefa['custo']); ?>" required>

        <label for="data_limite">Data Limite:</label>
        <input type="date" id="data_limite" name="data_limite"
            value="<?php echo htmlspecialchars($tarefa['data_limite']); ?>" required>

        <button type="submit">Atualizar</button>
        <button><a href="index.php">Voltar</a></button>
    </form>
</body>

</html>