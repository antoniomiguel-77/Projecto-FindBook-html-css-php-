<?php
session_start();// inicia uma sessão que está em aberto

if(isset($_GET['l'])):
    // destroir as sessões existentes
 unset($_SESSION['email']);
 unset($_SESSION['senha']);
 unset($_SESSION['nivel']);

 header('Location:index.php');//direciona o usuário a tela principal


endif;