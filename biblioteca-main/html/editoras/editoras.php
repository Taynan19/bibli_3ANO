<?php
session_start();
require_once '../funcoes.php';
verificarLogin();

echo "<h1> Inserir Editora </h1>";
inserirEditora($conexao, "Editora Alfa", "Brasil");
echo "Editora inserida com sucesso!";


echo "<h1> Buscar editora por ID </h1>";
$editora = buscarEditoras($conexao, 4);
print_r($editora->fetch_assoc());
echo "<br>";

echo "<h1> Buscar leitor por nome </h1>";
$editora = buscarEditorasPorNome($conexao, "Alfa");
while($editoras = $editora->fetch_assoc()){
    print_r($editoras);
    echo "<br>";
}

echo "<h1> Atualizar Editora </h1>";
atualizarEditora($conexao, 1, "Editora Adauto", "EUA");
echo "Editora atualizada.";

echo "<h1> Deletar Leitor </h1>";
deletarEditora($conexao, 2);
echo "Editora deletado";

?>