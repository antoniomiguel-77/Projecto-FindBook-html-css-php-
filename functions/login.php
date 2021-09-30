<?php

function Usuarios($email){
    $pdo = getCon();
    $sql = "SELECT * FROM tb_usuarios WHERE email = ? limit 1";
    $logar = $pdo->prepare($sql);
    $logar->bindValue(1,$email);
    $logar->execute();
    return  $logar->fetchAll(PDO::FETCH_ASSOC);
    
}