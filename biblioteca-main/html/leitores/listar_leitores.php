<?php
session_start();
require_once '../funcoes.php';
verificarLogin();
require_once "../includes/cabecalho.php";


echo "<h2> Leitores Cadastrados </h2>";
$leitor = listarLeitores($conexao);
while($leitores = $leitor->fetch_assoc()){
    print_r($leitores);
    echo "<br>";
}

?>

