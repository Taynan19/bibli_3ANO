<?php
    require_once "conexao.php";
    require_once "funcoes.php";

    $nome = $_POST;
    inserirLeitor($conexao, "Pedro", "123", "111", "111", "2006-06-06", "Admin");


?>
