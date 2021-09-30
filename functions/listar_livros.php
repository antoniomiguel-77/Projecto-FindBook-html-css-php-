<?php

function listarLivros(){
    $pdo = getCon();
    $sql = "SELECT * FROM tb_livros";
    $resultado = $pdo->prepare($sql);
    $resultado->execute();


    return $resultado->fetchAll(PDO::FETCH_ASSOC);

}