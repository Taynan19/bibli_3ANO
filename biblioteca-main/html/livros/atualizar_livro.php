<?php

require_once '../funcoes.php';

if (isset($_POST['atualizar'])) {

    $id = $_POST['id']??'';
    $titulo = $_POST['titulo']??'';
    $data_publicacao = $_POST['data_publicacao']??'';
    $genero = $_POST['genero']??'';
    $editora = $_POST['editora']??'';

    $arquivoImagem = $_FILES['foto']?? null;

    if (atualizarLivro(
        $conexao,
        $id,
        $titulo,
        $data_publicacao,
        $genero,
        $arquivoImagem,
        $editora
    )) {
        echo "Livro atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o livro.";
    }
}

$livros = listarLivros($conexao);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <label for="livro_id">Selecionar Livro:</label><br>
            <select name="id" id="livro_id" required>
                <option value="">-- Escolha um livro --</option>
                <?php while ($livro = $livros->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($livro['id']) ?>">
                        #<?php echo htmlspecialchars($livro['id']) ?> - <?php echo htmlspecialchars($livro['titulo']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        <br><br>
        <label>Título:</label>
        <input type="text" name="titulo"><br><br>
        <label>Data:</label>
        <input type="date" name="data_publicacao"><br><br>
        <label>Gênero:</label>
        <input type="text" name="genero"><br><br>
        <label>Editora:</label>
        <input type="number" name="editora"><br><br>
        <label>Capa:(deixe em branco para manter a atual)</label><br>
        <input type="file" name="foto"><br><br>
        <button type="submit" name="atualizar">Atualizar Livro</button>
    </form>
    
</body>
</html>