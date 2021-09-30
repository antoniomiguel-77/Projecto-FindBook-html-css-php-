<?php
    require "./functions/conexao.php";
    require "./functions/listar_livros.php";

    //Se o botao for clicado 
if(isset($_POST['cad_livro'])):

    /**Filtrar registros digitados nos campos */
    $autor = filter_input(INPUT_POST,'autor',FILTER_SANITIZE_STRING);
    $titulo = filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_STRING);
    $editora = filter_input(INPUT_POST,'editora',FILTER_SANITIZE_STRING);

    $capa = $_FILES["capa"]["name"];
    $tmp_capa = $_FILES['capa']['tmp_name'];

    $livro = $_FILES['livro']['name'];
    $tmp_livro = $_FILES['livro']['tmp_name'];

    /**Verificar se os campos foram preenchidos */
    $permitir = false;
    $erros = array();
    if(!empty($autor) || !empty($titulo) || !empty($editora) || !empty($capa) || !empty($livro)):
        $permitir = true;
    else:
        $erros[] = "<li>Todos os campos são obrigatórios</li>";

    endif;
    /**Substituir caracteres dos ficheiros */
        require "substituir.php";  
    /**Pegar registros do banco de dados */  
        $registros = listarLivros();
    foreach($registros as $livros):
        $id_livro = $livros['ID_LIVRO'];
    endforeach;

    /** Realizar cadastro de livros no banco de dados */

    if($permitir == true):
    /**Carregar foto de capa */
        $extencaoCapa = ['png','jpeg','jpg'];
        $extencao = pathinfo($capa,PATHINFO_EXTENSION);
        @$id_livro +=1;
        $pasta_capas = "./capas/capa$id_livro";

     /**Criar pasta para armazenar capas dos livros */
     if(!file_exists($pasta_capas)):
        mkdir($pasta_capas,0777);
    endif;

    if(in_array($extencao,$extencaoCapa)):
        move_uploaded_file($tmp_capa,$pasta_capas."/".$capa);
    else:
        $erros[] = "<li>Extenção não permitida</li>";
    endif;

    //Carregar ficheiro pdf 
        $extencaoLivro = pathinfo($livro,PATHINFO_EXTENSION);
        $pasta_pdf = "./livros/livro$id_livro";

    //Criar pasta para armazenar livros 
    if(!file_exists($pasta_pdf)):
        mkdir($pasta_pdf,0777);
    endif;
    if($extencaoLivro == "pdf"):
        move_uploaded_file($tmp_livro,$pasta_pdf."/".$livro);
    else:
        $erros[] = "<li>Extencao do livro invalida</li>";
    endif;
    

        $pdo = getCon();
        $sql = "INSERT INTO tb_livros(autor,titulo,editora,capa,livro,id_user) VALUES(?,?,?,?,?,?)";
        $cadastrar = $pdo->prepare($sql);
        $cadastrar->bindValue(1,$autor);
        $cadastrar->bindValue(2,$titulo);
        $cadastrar->bindValue(3,$editora);
        $cadastrar->bindValue(4,$capa);
        $cadastrar->bindValue(5,$livro);
        $cadastrar->bindValue(6,'1');
        $cadastrar->execute();
    header('Location:form_cad_livro.php');//redireciona o admin para a tela de cadastro de livro
    else:
        $erros[] = "<li>Erro ao cadastrar livro</li>";

    endif;
    /**Apresenta os erros caso haja */
    if(!empty($erros)):
        echo"<h1 style='text-align:center; text-transform:uppercase;color:red' >Erros encontrados</h1>";
        foreach($erros as $erro):
                echo" <strong style='text-align:center;text-transform:uppercase;color:#043E95'>$erro</strong><br>";
        endforeach;
       echo " <h1 style='text-align:center;'><a href='index.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Home</a> |";
       echo " <a href='form_cad_livro.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Cadastrar-livro</a></h1>";
          
    endif;
    


 

endif;

