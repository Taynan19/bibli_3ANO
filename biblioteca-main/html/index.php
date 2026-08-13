<?php
    require_once "conexao.php";
    require_once "funcoes.php";

    $nome = $_POST;
    inserirLeitor($conexao, "Pedro", "123", "111", "111", "2006-06-06", "Admin");
    echo "<br>";
    echo "Olá";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<a href="loguin.php">loguin</a>
</body>
</html>