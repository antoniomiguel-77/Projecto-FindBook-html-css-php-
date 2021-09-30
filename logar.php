<?php
    require "functions/conexao.php";
    require "functions/login.php";
    session_start();
if(isset($_POST['login'])):
//Filtrar os registros digitados nos campos 
    $erros = array();
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING);
//Validar email digitado pelo usuario 
if(!$email = filter_var($email,FILTER_VALIDATE_EMAIL)):
    $erros[] = "<li>Email digitado não existe.</li>";
endif;

//Array de registros 
    $registros = Usuarios($email);
foreach($registros as $usuario){
   $email_db =  $usuario['EMAIL'];
   $senha_db = $usuario['SENHA'];
   $nivel_db = $usuario['NIVEL'];
}


//Autenticar Senha Criptografada 
    @$hash_senha = password_verify($senha,$senha_db);

//Realizar login
if($email == @$email_db && $senha == $hash_senha):

    if($nivel_db == 1):
        $_SESSION['email'] = $email_db;
        $_SESSION['senha'] = $senha;
        $_SESSION['nivel'] = $nivel_db;

        header('Location:area_adm');// direciona o admin para tela de admin

    else:
        $_SESSION['email'] = $email_db;
        $_SESSION['senha'] = $senha;
        $_SESSION['nivel'] = $nivel_db;
        header('Location:area_cliente');// direciona o cliente para a tela de cliente
    endif;
    
else:
    $erros[] = "<li>Email ou Senha inválidas</li>";
endif;

// Exibir Erros caso haja
if(!empty($erros)):
    echo"<h1 style='text-align:center; text-transform:uppercase;color:red' >Erros encontrados</h1>";
    foreach($erros as $erro):
            echo" <strong style='text-align:center;text-transform:uppercase;color:#043E95'>$erro</strong><br>";
    
    endforeach;
   echo " <h1 style='text-align:center;'><a href='index.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Home</a> |";
   echo " <a href='form_cad_user.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Cadastrar-se</a> | ";
   echo " <a href='form_login.php'style='text-align:center;text-transform:uppercase;color:#043E95;text-decoration: none;'>Logar</a></h1>";

    endif;

endif;