<?php
session_start();
require_once '../funcoes.php';
verificarLogin();
require_once "../includes/cabecalho.php";

echo "<h2>Listar Empréstimos</h2>";

$emprestimos = listarEmprestimos($conexao);
while($emp = $emprestimos->fetch_assoc()){
    print_r($emp);
    echo "<br>";
}
?>

