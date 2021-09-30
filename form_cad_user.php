<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cadastrar-se</title>
</head>
<body>
 <img src="" alt="">

    <section class="tela-cadastro">
        <h1>Cadastra-se aqui</h1>
        <form action="cad_usuario.php" method="post" enctype="multipart/form-data">
            <p><input type="text" name="nome" placeholder="Nome Completo"></p>
            <p><input type="email" name="email" placeholder="E-mail"></p>
            <p><input type="password" name="senha" placeholder="Senha"></p>
            <p><input type="password" name="resenha" placeholder="Confirmar Senha"></p>
            <label>Foto:</label>
            <p><input type="file" name="foto" title="Adicionar foto"></p>
            <p><button type="submit" name="cad_usuario">Salvar</button> <button type="reset">Limpar</button></p>
        </form>
        <div class="area_cad">
            <a href="index.php">&leftarrow; Ir para Home </a>
            <a href="form_login.php">Ir para Login&rightarrow;</a>
        </div>
            
    </section>

&rightarrow;
 
</body>
</html>