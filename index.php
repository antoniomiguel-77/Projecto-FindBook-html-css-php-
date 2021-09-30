<?php
  require "./functions/listar_livros.php";
  require "./functions/buscar.php";
  require "./functions/conexao.php";



 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">
    <link rel="shortcut icon" href="app/img/logo-find-book.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <title>FindBook</title>
</head>
<body>
  <!-- Area Header -->
  <header class="topo" id="topo">
      <div class="logo">
        <img src="./img/logo-find-book.png" alt="">
        <h1>Find Book</h1>
      </div>

      <!--Arquivo que verifica a sessão-->
      <?php require "verificarSessao.php"?>
       <nav class="menu">
          <ul>
            <li><a href="index.php" class="link_menu">Home</a> </li>
            <li><a href="#sobre" class="link_menu">Sobre</a> </li>
            <li><a href="#contato" class="link_menu">Contato</a> </li>
          </ul>
      </nav>
  </header>
  <section class="corpo">
    <form action="" method="post" class="form_search">
        <input type="search" name="search" placeholder=" Digite o titulo do livro">
        <button type="submit" name="buscar" class="btn-search">Pesquisar</button>
    </form>
  </section>

  <!-- Area dos livros -->
  <section class="livros">
    <?php 

     
     $registros;
    if(isset($_POST['buscar']) && isset($_POST['search']) != ""):
      $search = filter_input(INPUT_POST,'search',FILTER_SANITIZE_STRING);
      $registros = buscarLivro("$search");
    else:
      $registros = listarLivros();
   
    endif;
    

   
    ?>

    
    <?php foreach($registros as $livros): ?>
    <div>
      <img src="./capas/capa<?php echo $livros['ID_LIVRO'] ?>/<?php echo $livros['CAPA'] ?>" class="capa">
      <p>Autor: <?php echo $livros['AUTOR'] ?> </p>
      <p>Titulo:  <?php echo $livros['TITULO'] ?></p>
      <p>Editora: <?php echo $livros['EDITORA'] ?> </p>
       <?php 
       if(@$_SESSION['nivel'] == 1):
        echo "<a href=form_edit_livro.php?edit=$livros[ID_LIVRO] class='btn_edit'>Editar</a>  <a href=del_livro.php?del=$livros[ID_LIVRO] class='btn_delete'>Deletar</a>";
       else:
        if(@$_SESSION['nivel'] == 2):
        echo "<a href='area_leitura.php?ler=$livros[ID_LIVRO]' class='btn_ler'>Ler</a>  <a href='livros/livro$livros[ID_LIVRO]/$livros[LIVRO]' download='$livros[LIVRO]'  type= 'application/pdf' class='btn_baixar'>Baixar</a>";
        else:
            echo"";
       
        endif;
      endif;
    

        ?>
    </div>
    <?php endforeach; ?>
      </section>
 
<!-- FIM DO CORPO -->
 <!-- SOBRE A PAGINA -->
 
<section class="sobre" id="sobre">
 <h3>Sobre o site</h3>
  <p>
   <strong>FIND BOOK</strong>, foi desenvolvido para ajudar os estudantes de <strong>TI</strong>  nas suas busca por livro no dia dia de maneira simples e rápida.  </strong>
   Não inportando muito em que area da <strong>TI</strong> ele atua. Disponibilizando assim uma vasticíma quantidade de e-books.
  </p>
 

</section>


  <!-- FIM SOBRE A PAGINA -->

<!-- Contacto -->

<section  id="contato">
    
  <form action="" method="post" class="area_contato">
    <h3>Entre em contacto</h3>
  
    <p><input type="email" name="email" placeholder="E-mail" class="contato_campos"></p>
    <p><textarea name="msg" id="" cols="30" rows="10" maxlength="255" placeholder="Mensagem" class="contato_campos" ></textarea></p>
    <button type="submit" class="btn_contato_campos">Enviar</button>
     
  </form>

</section>

<!--Fim do contacto -->

<!--RODAPE -->
  <footer class="rodape">
    <a href="#topo"><img src="./img/top.png" alt="voltar ao topo" title="voltar ao topo" class="top"></a>
      <h3>Encontra-me nas redes socias</h3>
      
      <div class="redes">
        <a href=""><img src="./img/facebook.png" alt="logo-facebook"></a>
        <a href=""><img src="./img/whatsaap.png" alt="logo-whatsaap"></a>
        <a href=""><img src="./img/instagram.png" alt="logo-instagram"></a>
        <a href=""><img src="./img/github.png" alt="logo-github"></a>
      </div>
        <h3>Criado por António Miguel</h3>
        <h4>&copy; All right reserveds</h4>

  </footer>
 
</body>
</html>