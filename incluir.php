<?php 
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_tarefa = $_POST['nome_tarefa'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];

    $verifica_nome = "SELECT * FROM tarefas WHERE nome_tarefa = '$nome_tarefa'";
    $resultado_verifica = mysqli_query($conn, $verifica_nome);

    if (mysqli_num_rows($resultado_verifica) > 0) {
        echo "<script>alert('Erro: Já existe uma tarefa com esse nome.');</script>";
    } else {
        // Calcula a próxima ordem de apresentação
        $ordem_apresentacao_query = "SELECT COALESCE(MAX(ordem_apresentacao), 0) + 1 AS nova_ordem FROM tarefas";
        $resultado_ordem = mysqli_query($conn, $ordem_apresentacao_query);
        $row_ordem = mysqli_fetch_assoc($resultado_ordem);
        $nova_ordem = $row_ordem['nova_ordem'];

        $sql = "INSERT INTO tarefas (nome_tarefa, custo, data_limite, ordem_apresentacao) VALUES ('$nome_tarefa', '$custo', '$data_limite', $nova_ordem)";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Tarefa incluída!');</script>";
        } else {
            echo "<script>alert('Erro: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Nova Tarefa</title>
    <link rel="stylesheet" href="styles/adicionar.css"> <!-- Link para o CSS estilizado -->
</head>

<body>
    <div class="container">
        <h1>Incluir Nova Tarefa</h1>
        <form action="" method="POST">
            <label for="nome_tarefa">Nome da Tarefa:</label>
            <input type="text" id="nome_tarefa" name="nome_tarefa" required>

            <label for="custo">Custo:</label>
            <input type="number" id="custo" name="custo" required>

            <label for="data_limite">Data Limite:</label>
            <input type="date" id="data_limite" name="data_limite" required>

            <button type="submit" class="button-submit">Adicionar</button>
            <a href="index.php" class="button-voltar">Voltar para Lista de Tarefas</a>
        </form>
    </div>
</body>

</html>