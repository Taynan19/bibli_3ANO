<?php
    $host = "mysql_lab"; //alterar host
    $user = "root";
    $password = "123"; //Alterar senha
    $bd = "banco";

    $conexao = new mysqli($host, $user, $password, $bd);

    if($conexao->connect_error){
        die("Erro na conexão" . $conexao->connect_error);
    }

    echo "Conectado com sucesso";
?>