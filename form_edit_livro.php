<?php
    require "./functions/encontrar_livro.php";
    
    $id_livro = $_GET['edit'];
    $livroEncontrado = encontrarLivro($id_livro);
    foreach($livroEncontrado as $livro):
        $autor_db = $livro['AUTOR'];
        $titulo_db = $livro['TITULO'];
        $editora_db = $livro['EDITORA'];
        
    endforeach;

       
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
        <h1>Editar livro</h1>
        <form action="edit_livro.php" method="post" enctype="multipart/form-data">
            <p><input type="text" name="autor" placeholder="Autor" value="<?php echo $autor_db; ?>"></p>
            <p><input type="text" name="titulo" placeholder="Titulo" value="<?php echo $titulo_db;?>"></p>
            <p><input type="text" name="editora" placeholder="editora" value="<?php echo $editora_db; ?>"></p>
            <label>Foto da capa:</label>
            <p><input type="file" name="capa" title="Adicionar capa do livro"></p>
            <label>Livro:</label>
            <p><input type="file" name="livro" title="Adicionar livro"  ></p>
            <input type="hidden" name="id_livro" value="<?php echo $id_livro; ?>">
            <p><button type="submit" name="cad_livro">Salvar</button> <button type="reset">Limpar</button></p>
        </form>
        <div class="area_cad">
            <a href="index.php">&leftarrow; Ir para Home </a>
            <a href="adm.php"> painel de adminstrador&rightarrow;</a>
        </div>
             
    </section>

 
</body>
</html>