<?php 
include "db.php";
$sql = "SELECT * FROM tarefas"; 
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Fatto</title>
    <script src="scripts/scripts.js"></script>
    <script src="scripts/scriptseditar.js"></script>
    <script src="scripts/reodenar.js"></script>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>

    <h1>Lista de Tarefas</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Custo(R$)</th>
            <th>Data limite</th>
            <th>Ações</th>
        </tr>
        <?php 
        if (mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $amarelar = '';
                if($row['custo'] >= 1000){
                    $amarelar = 'amarelou';
                }
                echo "<tr class='$amarelar'>";
                echo "<tr id='tarefa_" . $row['id'] . "' class='$amarelar' draggable='true' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event)'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome_tarefa'] . "</td>";
                echo "<td>" . $row['custo'] . "</td>";
                echo "<td>" . $row['data_limite'] . "</td>";
                echo "<td>
                 <button onclick='abrirModalEdicao(" . json_encode($row) . ")'><img src='imgs/editar.png' ></button>
                <button onclick='confirmarExclusao(" . $row['id'] . ")'><img src='imgs/excluir.png'></button>
                </td>";
                echo "</tr>";
            }
        }           
        else{
            echo "<tr>Não foram encontrada tarefas</tr>";
        }
        ?>
    </table>
    <div class="button-container">
        <a href="incluir.php" class="button-adicionar"><img src="imgs/adicioar.png" alt="adicionar"> Adicionar
            Tarefa</a>
    </div>

    <!-- Edição -->
    <div id="modalEdicao" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="fecharModalEdicao()">&times;</span>
            <h3>Editar Tarefa</h3>
            <form id="formEdicao" method="POST" action="editar.php">
                <input type="hidden" id="id_tarefa" name="id_tarefa"> <!-- Campo oculto para o ID -->
                <label for="nome_tarefa">Nome:</label>
                <input type="text" id="nome_tarefa" name="nome_tarefa" required>
                <label for="custo">Custo:</label>
                <input type="number" id="custo" name="custo" required>
                <label for="data_limite">Data Limite:</label>
                <input type="date" id="data_limite" name="data_limite" required>
                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <!-- Pop-up de Confirmação -->
    <div id="modalConfirmacao" class="modal">
        <div class="modal-content">
            <span class="close"
                onclick="document.getElementById('modalConfirmacao').style.display='none'">&times;</span>
            <h3>Confirmar Exclusão</h3>
            <p>Você tem certeza que deseja excluir esta tarefa?</p>
            <button id="confirmarBtn">Sim</button>
            <button id="cancelarBtn"
                onclick="document.getElementById('modalConfirmacao').style.display='none'">Não</button>
        </div>
    </div>

</body>


</html>