<?php

function buscarLivro($titulo){
    $pdo = getCon();
    $sql = "SELECT * FROM tb_livros WHERE TITULO LIKE '%".$titulo."%'";
    $buscar = $pdo->prepare($sql);
    $buscar->execute();
    return  $buscar->fetchAll(PDO::FETCH_ASSOC);
}