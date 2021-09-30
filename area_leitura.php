<?php
require "functions/encontrar_livro.php";
if(isset($_GET['ler'])):
    $id = filter_input(INPUT_GET,'ler',FILTER_SANITIZE_NUMBER_INT);
    $ler = encontrarLivro($id);

    foreach($ler as $livros){
        $livro_db = $livros['LIVRO'];
    }

   
  
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="app/img/logo-find-book.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>FindBook</title>
</head>
<body>

 

<objec data="livros/livro<?php echo $id ?>/<?php echo $livro_db ?>" type=""></objec>

</body>
</html>


 