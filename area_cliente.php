<?php
require "functions/conexao.php";
require "functions/login.php";
session_start();
if(!isset($_SESSION['email']) && !isset($_SESSION['nivel'])):
    header('location:index.php');
else:
    $registros = Usuarios($_SESSION['email']);
    foreach($registros as $usuarios);
    
endif;

 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Find Book</title>
</head>
<body>
    <section class="area-adm tela-login ">
        <img src="./usuario/usuario<?php echo $usuarios['ID_USER']?>/<?php echo $usuarios['FOTO'] ?>" alt="foto-do-cliente">

        <div >
            
            <a href="index.php" class="links">Ir para Home</a>
            <a href="logout.php?l=true" class="links">Terminar sessão</a>

        </div>
    </section>

 
</body>
</html>