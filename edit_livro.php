<?php

    
    require "./functions/conexao.php";//funcao de conexao com o banco de dados

    if(isset($_POST['cad_livro']) & isset($_POST['id_livro'])):
        //Filtrar os campos
        $autor = filter_input(INPUT_POST,'autor',FILTER_SANITIZE_STRING);
        $titulo = filter_input(INPUT_POST,'titulo',FILTER_SANITIZE_STRING);
        $editora = filter_input(INPUT_POST,'editora',FILTER_SANITIZE_STRING);
        $id_livro = filter_input(INPUT_POST,'id_livro',FILTER_SANITIZE_NUMBER_INT); 

        $capa = $_FILES['capa']['name'];
        $tmp_capa = $_FILES['capa']['tmp_name'];

        $livro= $_FILES['livro']['name'];
        $tmp_livro = $_FILES['livro']['tmp_name'];

        $permitir = false;
        $erros = array();
            //Verificar se os campos estao vasios
        if(!empty($autor) || !empty($titulo) || !empty($editora) || !empty($capa) || !empty($livro)):
            $permitir = true;
        else:
            $erros[] = "<li>Todos os campos são obrigatórios</li>";
    
        endif;

        //Editar livro
        if($permitir ==true):

         //Carregar foto de capa
         $extencaoCapa = ['png','jpeg','jpg'];
         $extencao = pathinfo($capa,PATHINFO_EXTENSION);
         
         $pasta_capas = "./capas/capa$id_livro";
        //Criar pasta para armazenar capas dos livros 
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
        
        // Actualizar registros

    $pdo = getCon();
    $sql = "UPDATE tb_livros SET autor = ?,titulo = ?,editora = ?,capa = ?,livro = ? WHERE id_livro = ?";
    $cadastrar = $pdo->prepare($sql);
    $cadastrar->bindValue(1,$autor);
    $cadastrar->bindValue(2,$titulo);
    $cadastrar->bindValue(3,$editora);
    $cadastrar->bindValue(4,$capa);
    $cadastrar->bindValue(5,$livro);
    $cadastrar->bindValue(6,$id_livro);
    $cadastrar->execute();
    header('Location:index.php');

    else:
    $erros[] = "<li>Erro ao actualizar livro</li>";

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

    



?>
