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
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 20px;
    }
    h1 {
        color: #333;
    }
    .leitor {
        background-color: #fff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

</head>

<body>

    <a href="index.php">voltar</a>

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

    echo "<h1>Buscar Leitor Por Nome</h1>";
    $leitor = buscarLeitor($conexao, 2);
    print_r($leitor->fetch_assoc());
    echo "<br>";

    echo "<h1>Atualizar Leitor</h1>"
    atualizarLeitor($conexao, 1, "Joana", "123", "55555555555555", "62998989898", "2001-12-66", "admin");
    echo"Leiror atualizado";

    echo "<h1>Deletar Leitor</h1>"
    deletarLeitor($conexao, 2);
    echo "Leitor deletado";

    echo "<h1>Inserir Editora</h1>"
    inserirEditoras ($conexao, 10, "Ney Edição", "Brasil");
    echo "editora Criada";

    echo "<h1>Listar Editoras</h1>";
    $editora = listarEditora($conexao);
    while($e = $editora -> fetch_assoc()){
        print_r($e);
        echo"<br>";
    
    
    }
    
    ?>

    
</body>

</html>