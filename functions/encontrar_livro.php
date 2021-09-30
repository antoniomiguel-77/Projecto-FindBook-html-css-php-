<?php
require "conexao.php";
function encontrarLivro($id_livro){

    $pdo = getCon();
    $sql = "SELECT * FROM tb_livros WHERE ID_LIVRO = ? ";
    $encontrar = $pdo->prepare($sql);
    $encontrar->bindValue(1,$id_livro);
    $encontrar->execute();
    return $encontrar->fetchAll(PDO::FETCH_ASSOC);
}