<?php
session_start();
require_once '../funcoes.php';
verificarLogin();

//echo "<h1> Inserir Leitor </h1>";
//inserirLeitor($conexao, "Adauto", "123", "1111111111", "62991111111", "2000-01-01", 
//"admin");
//echo "Leitor inserido <br>";


echo "<h1> Buscar leitor por ID </h1>";
$leitor = buscarLeitores($conexao, 1);
print_r($leitor->fetch_assoc());
echo "<br>";


echo "<h1> Buscar leitor por nome </h1>";
$leitor = buscarLeitoresPorNome($conexao, "Adauto");
while($leitores = $leitor->fetch_assoc()){
    print_r($leitores);
    echo "<br>";
}

echo "<h1> Atualizar Leitor </h1>";
atualizarLeitor($conexao, 1, "Joana", 123, "5555555555", "629777777", 
"1985-02-02", "admin");

echo "<h1> Deletar Leitor </h1>";
deletarLeitor($conexao, 2);
echo "Leitor deletado";

echo "<br>";

echo "<a href='../index.php'>Voltar</a>";
?>