<?php
session_start();
require_once "funcoes.php";

if (isset($_POST['enviar'])){

    $cpf = $_POST['cpf']??'';
    $senha = $_POST['senha']??'';

    $sucesso = login($conexao, $cpf, $senha);

    if ($sucesso === true){
        header("Location: index.php");
        exit;
    } elseif($sucesso === false){
        echo "CPF ou senha incorretos.";
    } elseif($sucesso === "erro"){
        echo "Ocorreu um erro ao realizar o login.";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h3>Login</h3>
        <label>CPF:</label>
        <input type="text" name="cpf" required><br><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br><br>
        <button type="submit" name="enviar">Login</button>
    </form>
    
</body>
</html>