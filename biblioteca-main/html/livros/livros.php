<?php
session_start();
require_once '../funcoes.php';
verificarLogin();

if (isset($_POST['enviar'])) {
    // Obter e remover espaços em branco das extremidades
    $titulo = $_POST['titulo'] ?? '';
    $data_publicacao = $_POST['data_publicacao'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $editora = $_POST['editora'] ?? '';
    $arquivoImagem = $_FILES['capa'] ?? null;


    $sucesso = inserirLivro($conexao, $titulo, $data_publicacao, $genero, $arquivoImagem, $editora);

    if ($sucesso) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro no cadastro do livro. Verifique a imagem ou a conexão.";
    }
    
}
?>

<form method="POST" enctype="multipart/form-data">
    <p>
        <label>Título: </label><br>
        <input type="text" name="titulo" required>
    </p>
    <p>
        <label>Data de Publicação: </label><br>
        <input type="date" name="data_publicacao" required> 
    </p>
    <p>
        <label>Gênero: </label><br>
        <input type="text" name="genero" required>
    </p>
    <p>
        <label>ID da Editora: </label><br>
        <input type="number" name="editora" required>
    </p>
    <p>
        <label>Capa do Livro: </label><br>
        <input type="file" name="capa" required>
    </p>
    <button type="submit" name="enviar">Enviar Imagem</button>
</form>

<br><br>

<?php

echo "<h3>Deletar Livros</h3>";
$deletado = deletarLivro($conexao, 1);
if($deletado){
    echo "Livro deletado com sucesso.";
}else{
    echo "Erro ao deletar livro. Verifique se o livro está cadastrado.";
}

echo "<br>";

echo "<a href='../index.php'>Voltar</a>";
    
?>