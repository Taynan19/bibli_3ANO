<?php
session_start();
require_once '../funcoes.php';
verificarLogin();
require_once "../includes/cabecalho.php";

echo "<h2> Listar Editoras </h2>";
$editora = listarEditoras($conexao);
while($editoras = $editora->fetch_assoc()){
    print_r($editoras);
    echo "<br>";
}
?>