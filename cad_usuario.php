<?php

        require "functions/conexao.php";//função de conexao
        require "functions/listar_usuarios.php";//função que lista os usuários

    
// Lógica para cadastrar os usuários
if(isset($_POST['cad_usuario'])):
    
        $erros = array();//Array para armazenar os erros

    //Filtrar e validar os registros digitados pelo usuário
        $nome = filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        
    if(!$email = filter_var($email,FILTER_VALIDATE_EMAIL)):
        $erros[] = "<li>E-mail inválido</li>";
    endif;

    $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);
    $resenha = filter_input(INPUT_POST,'resenha',FILTER_SANITIZE_STRING);

    // Armazenar a foto carregada
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    /**Verificar se todos os campos foram preenchidos */
    $permitir = false;
    if(!empty($nome) || !empty($email) || !empty($senha) || !empty($resenha) || !empty($foto)):

        if($senha == $resenha):

            $permitir = true;//se true permite o cadastro
                
        else:
            $erros[] = "<li>Senha nao correspondem</li>";
        endif;
    else:
            $erros[] = "<li>Todos campos sao obrigatórios</li>";
    endif;

   require "./substituir2.php";//Arquivo que faz a substituição dos caracteris especias
    
   //pegar registros dos usuários no banco de dados 
    $registros = listarUsuarios();

   foreach($registros as $usuarios):
            $id_user = $usuarios['ID_USER'];
   endforeach;
   
   //Caso varial permitir == true Realizar Cadastro no banco de dados
       
   if($permitir == true):

      // Carregar fotos dos usuarios
      $extencoesPermitdas = ['png','jpg','jpeg'];
      $extencaoFoto = pathinfo($foto,PATHINFO_EXTENSION);
      $id_user += 1;
      $pasta = "./usuario/usuario$id_user";

      if(!file_exists($pasta)):
            mkdir($pasta);//essa função cria uma a pasta 
      endif;
      // se a extenção do arquivo carregado for permitido, carrega o arquivo  na pasta
      if(in_array($extencaoFoto,$extencoesPermitdas)):
         move_uploaded_file($tmp,$pasta."/".$foto);        
      else:

          $erros[] ="<li>Erro ao carregar foto</li>";
      
      endif;

    //Criptografar a senha antes de realizar o cadastro 
    $senhaSegura = password_hash($senha,PASSWORD_DEFAULT);

    
    $pdo = getCon();
    $sql = "INSERT INTO tb_usuarios(nome,email,senha,foto,nivel) VALUES(?,?,?,?,?)";
    $cadastrar = $pdo->prepare($sql);
    $cadastrar->bindValue(1,$nome);
    $cadastrar->bindValue(2,$email);
    $cadastrar->bindValue(3,$senhaSegura);
    $cadastrar->bindValue(4,$foto);
    $cadastrar->bindValue(5,'2');

    $cadastrar->execute();
    header('Location:form_login.php');// direciona o usuarios a tela de login
   else:
    $erros[] = "<li>Erro ao cadastrar usuário</li>";
   
   endif;
   
   
   endif;
 
 
//Apresentar erros armazenados na array erros caso haja 

if(!empty($erros)):
    echo"<h1 style='text-align:center; text-transform:uppercase;color:red' >Erros encontrados</h1>";
    foreach($erros as $erro):
            echo" <strong style='text-align:center;text-transform:uppercase;color:#043E95'>$erro</strong><br>";
    
        endforeach;
   echo " <h1 style='text-align:center;'><a href='index.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Home</a> |";
   echo " <a href='form_cad_user.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Cadastrar-se</a></h1>";
      
endif;

?>
 


