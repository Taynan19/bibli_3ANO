<?php
session_start();
require_once '../funcoes.php';
verificarLogin();
require_once "../includes/cabecalho.php";

echo "<h2>Listar Livros</h2>";

$livros = listarLivros($conexao);
while($l = $livros->fetch_assoc()){
    if (!empty($l['foto'])) {
        echo "<img src='" . $l['foto'] . "' width='100' alt='Capa'><br>";
    } else {
        echo "<em>[Sem imagem]</em><br>";
    }

    print_r($l);
    echo "<hr>";
}

?>