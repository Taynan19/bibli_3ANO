<?php

session_start ();

require_once "funcoes.php";

if(isset($_post['enviar'])){
    $cpf = $_post['cpf']?? '';
    $senha = $_post['senha']?? '';

    $sucesso = loguin($conexao, $cpf, $senha);

    if ($sucesso){
        header('location: index.php');

        exit;
    } else{
        echo "erro loguin";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>loguin</h1>
    <form action="" methot= "POST">

    cpf: <input type="text" name="cpf" required> <br>
    senha: <input type="text" name= "senha" required> <br>

    <button type= "submit" name= ""enviar>loguin</button>
    </form>
</body>
</html>