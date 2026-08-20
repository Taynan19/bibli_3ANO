<?php
session_start();
require_once '../funcoes.php';
verificarLogin();

echo "<h2>9. Inserir Empréstimo</h2>";

inserirEmprestimo($conexao, 1, 2, "2024-01-01", "2024-01-10");

echo "Empréstimo inserido<br>";



echo "<h3>Atualizar Empréstimo</h3>";

atualizarEmprestimo($conexao, 1, 1, 1, "2024-01-02", "2024-01-15");

echo "Empréstimo atualizado<br>";

echo "<h3>Buscar Empréstimo</h3>";

$emp = buscarEmprestimo($conexao, 2);
print_r($emp->fetch_assoc());
echo "<br>";

?>