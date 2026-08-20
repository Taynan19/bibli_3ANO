<?php
require_once 'conexao.php';

function verificarLogin(){
    // return isset($_SESSION['usuario']);
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
    exit;
    }
}
function verificarAdmin(){
    return (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin');
    
}
function logout(){
    session_unset();   // Limpa todas as variáveis da sessão
    session_destroy(); // Destrói a sessão no servidor

    header("Location: login.php");
    exit;
}
function login($conexao, $cpf, $senha){
    $sql = "SELECT * FROM leitores WHERE cpf = ? and senha = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $cpf, $senha);
    
    if(!$stmt->execute()){
        return "erro";
    }

    $resultado = $stmt->get_result();

    if($resultado->num_rows > 0){
        $usuario = $resultado->fetch_assoc();

        $_SESSION['usuario'] = $usuario['nome'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['tipo'] = $usuario['tipo'];

        return true;
    }

    return false;
}

// ===============================
// CRUD - LEITOR
// ===============================


function inserirLeitor($conexao, $nome, $senha, $cpf, $telefone, $nascimento, $tipo){
    $sql = "INSERT INTO leitores (nome, senha, cpf, telefone, nascimento, tipo)
        VALUES (?,?,?,?,?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $senha, $cpf, $telefone, $nascimento, $tipo);
    return $stmt->execute();

}

function listarleitores($conexao){
    return $conexao->query("SELECT * FROM leitores");
}

function buscarLeitores($conexao, $id){
    $sql = "SELECT * FROM leitores WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function buscarLeitoresPorNome($conexao, $nome){
    $sql = "SELECT * FROM leitores WHERE nome LIKE ?";
    $stmt = $conexao->prepare($sql);
    $nomeBusca = "%".$nome."%";
    $stmt->bind_param("s", $nomeBusca);
    $stmt->execute();
    return $stmt->get_result();
}

function atualizarLeitor($conexao, $id, $nome, $senha, $cpf, $telefone, $nascimento, $tipo){
    $sql = "UPDATE leitores SET nome = ?, senha = ?, cpf = ?, telefone = ?, nascimento = ?, tipo = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $senha, $cpf, $telefone, $nascimento, $tipo, $id);
    return $stmt->execute();
}

function deletarLeitor($conexao, $id){
    $sql = "DELETE FROM leitores WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// ===============================
// CRUD - EDITORA
// ===============================

function inserirEditora($conexao, $nome, $pais){
    $sql = "INSERT INTO editoras (nome, pais)
        VALUES (?,?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $nome, $pais);
    return $stmt->execute();
}

function listarEditoras($conexao){
    return $conexao->query("SELECT * FROM editoras");
}

function buscarEditoras($conexao, $id){
    $sql = "SELECT * FROM editoras WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function buscarEditorasPorNome($conexao, $nome){
    $sql = "SELECT * FROM editoras WHERE nome LIKE ?";
    $stmt = $conexao->prepare($sql);
    $nomeBusca = "%".$nome."%";
    $stmt->bind_param("s", $nomeBusca);
    $stmt->execute();
    return $stmt->get_result();
}

function atualizarEditora($conexao, $id, $nome, $pais){
    $sql = "UPDATE editoras SET nome = ?, pais = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssi", $nome, $pais, $id);
    return $stmt->execute();
}

function deletarEditora($conexao, $id){
    $sql = "DELETE FROM editoras WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// ===============================
// UPLOAD DE CAPA
// ===============================

function uploadCapa ($arquivo){
    $diretorio = 'uploads/capas/';
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png'];

    if(!in_array($extensao, $permitidas)){ 
        return false;
    }

    if($arquivo['size']> 1024 * 1024 * 2){ // permite até 2MB
        return false;
    }

    $nomeArquivo = uniqid() . "_" . $arquivo['name'];
    $caminho = $diretorio . $nomeArquivo; // uploads/capas/13516516has5_arvore.png

    if (move_uploaded_file($arquivo['tmp_name'], $caminho)){
        return $caminho;
    }

    return false;
}


// ===============================
// CRUD - LIVROS
// ===============================
function inserirLivro($conexao, $titulo, $data_publicacao, $genero, $arquivoImagem, $editora){
    
    $caminhoImagem = uploadCapa($arquivoImagem);

    if(!$caminhoImagem){
        return false;
    }

    $sql = "INSERT INTO livros (titulo, data_publicacao, genero, foto, editora)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $data_publicacao, $genero, $caminhoImagem, $editora);
    
    return $stmt->execute();
}

function listarLivros($conexao){
    return $conexao->query("SELECT * FROM livros");
}

function buscarLivro($conexao, $id){
    $sql = "SELECT * FROM livros WHERE id=?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    return $stmt->get_result();
}

function atualizarLivro($conexao, $id, $titulo, $data_publicacao, $genero, $arquivoImagem, $editora){
    
    // Verifica se foi enviada uma nova imagem && sem erro
    if(isset($arquivoImagem) && $arquivoImagem['error'] === UPLOAD_ERR_OK){
        
        $caminhoImagem = uploadCapa($arquivoImagem);

        if(!$caminhoImagem){
            return false;
        }

        $sql = "UPDATE livros 
                SET titulo=?, data_publicacao=?, genero=?, foto=?, editora=?
                WHERE id=?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "ssssii",
            $titulo,
            $data_publicacao,
            $genero,
            $caminhoImagem,
            $editora,
            $id
        );

    } else {
        // Atualiza os dados caso o usuário não tenha alterado a capa
        $sql = "UPDATE livros 
                SET titulo=?, data_publicacao=?, genero=?, editora=?
                WHERE id=?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "sssii",
            $titulo,
            $data_publicacao,
            $genero,
            $editora,
            $id
        );
    }

    return $stmt->execute();
}

function deletarLivro($conexao, $id){
    $sqlBusca = "SELECT foto FROM livros WHERE id = ?";
    $stmtBusca = $conexao->prepare($sqlBusca);
    $stmtBusca->bind_param("i", $id);
    $stmtBusca->execute();
    $resultado = $stmtBusca->get_result();

    if ($livro = $resultado->fetch_assoc()) {
        if (!empty($livro['foto']) && file_exists($livro['foto'])) {
            unlink($livro['foto']);
        }

        $sqlDelete = "DELETE FROM livros WHERE id = ?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id);

        return $stmtDelete->execute();
    }

    return false;
}

// ===============================
// CRUD - EMPRESTIMOS
// ===============================
function inserirEmprestimo($conexao, $leitor, $livros, $data_inicio, $data_fim){
    $sql = "INSERT INTO emprestimos (leitor, livros, data_inicio, data_fim)
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiss", $leitor, $livros, $data_inicio, $data_fim);
    
    return $stmt->execute();
}

function listarEmprestimos($conexao){
    return $conexao->query("SELECT * FROM emprestimos");
}

function buscarEmprestimo($conexao, $id){
    $sql = "SELECT * FROM emprestimos WHERE id=?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    return $stmt->get_result();
}

function atualizarEmprestimo($conexao, $id, $leitor, $livros, $data_inicio, $data_fim){
    $sql = "UPDATE emprestimos 
            SET leitor=?, livros=?, data_inicio=?, data_fim=?
            WHERE id=?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iissi", $leitor, $livros, $data_inicio, $data_fim, $id);
    
    return $stmt->execute();
}

function deletarEmprestimo($conexao, $id){
    $sql = "DELETE FROM emprestimos WHERE id=?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    
    return $stmt->execute();
}

?>
