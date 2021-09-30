<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="app/css/style.css">
    <title>Fazer Login</title>
</head>
<body>



    <section class="tela-login">
        <h1>Login</h1>
      <form action="logar.php" method="post">
          <p><input type="email" name="email" placeholder="E-email"></p>
          <p><input type="password" name="senha" placeholder="Senha"></p>
          <input type="submit" value="Entrar" name="login">

      </form>
      <p>Não possui uma conta? <a href="form_cad_user.php" class = "link_menu">Cadastra-se.</a></p>
      <p>Esqueceu sua senha? <a href="#" class = "link_menu">Clica aqui.</a></p>
    </section>

 
</body>
</html>