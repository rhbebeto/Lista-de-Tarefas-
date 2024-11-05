<?php 
$db_host = "localhost";
$db_name = "listadetarefas";
$db_user = "root";
$db_pass = "";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Conexão falhou, Erro: " . mysqli_connect_error());
}

/*Desativar msg
echo "Conexão feita!";
*/ 
?>