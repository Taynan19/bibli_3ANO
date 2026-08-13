<?php
require_once 'funcoes.php';

// ===============================
// LEITORES - CRUD
// ===============================

echo "<h1> Inserir Leitor </h1>";
inserirLeitor($conexao, "Adauto", "123", "1111111111", "62991111111", "2000-01-01", 
"admin");
echo "Leitor inserido <br>";

echo "<h1> Listar Leitores </h1>";
$leitor = listarLeitores($conexao);
while($leitores = $leitor->fetch_assoc()){
    print_r($leitores);
    echo "<br>";
}

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


// ===============================
// EDITORA - CRUD
// ===============================

echo "<h1> Inserir Editora </h1>";
inserirEditora($conexao, "Editora Alfa", "Brasil");
echo "Editora inserida com sucesso!";

echo "<h1> Listar Editoras </h1>";
$editora = listarEditoras($conexao);
while($editoras = $editora->fetch_assoc()){
    print_r($editoras);
    echo "<br>";
}

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

// ===============================
// EMPRESTIMOS - CRUD
// ===============================
echo "<h2>9. Inserir Empréstimo</h2>";

inserirEmprestimo($conexao, 1, 1, "2024-01-01", "2024-01-10");

echo "Empréstimo inserido<br>";

echo "<h3>Listar Empréstimos</h3>";

$emprestimos = listarEmprestimos($conexao);

while($emp = $emprestimos->fetch_assoc()){
    print_r($emp);
    echo "<br>";
}

echo "<h3>Atualizar Empréstimo</h3>";

atualizarEmprestimo($conexao, 1, 1, 1, "2024-01-02", "2024-01-15");

echo "Empréstimo atualizado<br>";

echo "<h3>Buscar Empréstimo</h3>";

$emp = buscarEmprestimo($conexao, 1);
print_r($emp->fetch_assoc());
echo "<br>";
?>