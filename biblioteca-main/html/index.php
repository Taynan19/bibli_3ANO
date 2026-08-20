<?php
session_start();
require_once 'funcoes.php';
verificarLogin();
require_once "includes/cabecalho.php";

?>


<h3>Bem vindo(a) <?= $_SESSION['usuario'] ?> !</h3>
<ul>
    <li><a href="/leitores/leitores.php">Gerenciar Leitores</a></li>
    <li><a href="/editoras/editoras.php">Gerenciar Editoras</a></li>
    <li><a href="/livros/livros.php">Gerenciar Livros</a></li>
    <li><a href="/emprestimos/emprestimos.php">Gerenciar Empréstimos</a></li> 
</ul>



<?php
require_once "includes/rodape.php";
?>
