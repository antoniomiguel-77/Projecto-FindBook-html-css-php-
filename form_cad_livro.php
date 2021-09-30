<?php 
session_start();

if(isset($_SESSION['nivel'])):
   
($_SESSION['nivel'] !=1)? header('location:index.php'): "";
 
else:
    header('location:index.php');
endif;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="app/css/style.css">
    <title>Cadastrar-se</title>
</head>
<body>



    <section class="tela-cadastro">
        <h1>Cadastrar livros</h1>
        <form action="cad_livro.php" method="post" enctype="multipart/form-data">
            <p><input type="text" name="autor" placeholder="Autor"></p>
            <p><input type="text" name="titulo" placeholder="Titulo"></p>
            <p><input type="text" name="editora" placeholder="editora"></p>
            <label>Foto da capa:</label>
            <p><input type="file" name="capa" title="Adicionar capa do livro"></p>
            <label>Livro:</label>
            <p><input type="file" name="livro" title="Adicionar livro"></p>
            <p><button type="submit" name="cad_livro">Salvar</button> <button type="reset">Limpar</button></p>
        </form>
        <div class="area_cad">
            <a href="index.php">&leftarrow; Ir para Home </a>
            <a href="area_adm.php"> painel de adminstrador&rightarrow;</a>
        </div>
             
    </section>

 
</body>
</html>