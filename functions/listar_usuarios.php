<?php
function listarUsuarios(){
    $pdo = getCon();
    $sql = "SELECT * FROM tb_usuarios";
    $logar = $pdo->prepare($sql);
    $logar->execute();
    return  $logar->fetchAll(PDO::FETCH_ASSOC);
    
}