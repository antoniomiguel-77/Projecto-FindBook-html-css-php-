<?php
require "./functions/conexao.php";
if(isset($_GET['del'])):
    $id = $_GET['del'];
    $pdo = getCon();
    $sql = "DELETE FROM tb_livros WHERE ID_LIVRO = ?";
    $deletar = $pdo->prepare($sql);
    $deletar->bindValue(1,$id);
    $deletar->execute();
    
   header('Location:index.php');
endif;