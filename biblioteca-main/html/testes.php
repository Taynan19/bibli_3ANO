<?php
require_once "funcoes.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        
    </style>
</head>

<body>

    <?php

    // echo "<h1>Inserir Leitor</h1>";
    // inserirLeitor($conexao, "Neymar", "123", "12345678900", "62922224343", "2009-01-01", "admin");
    // echo "Leitor inserido com sucesso";

    echo "<h1>Listar Leitores</h1>";

    $leitor = listarLeitor($conexao);
    while ($l = $leitor->fetch_assoc()) {
        print_r($l);
        echo "<br>";
    }
    ?>

</body>

</html>