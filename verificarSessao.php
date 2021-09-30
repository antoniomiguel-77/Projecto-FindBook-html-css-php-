<?php
session_start();
if(!(isset($_SESSION['email']) && isset($_SESSION['nivel']))):
    echo "<div  class='logar'>";
    echo "<a href='form_cad_user.php' class = 'link_menu'>Cadastrar-se</a> | <a href='form_login.php' class = 'link_menu'>Logar</a>";
    echo "</div>";
else:
  if($_SESSION['nivel'] == 1):
    echo "<div  class='logar'>";
    echo "<a href='area_adm.php' class = 'link_menu'>Perfil admin</a> | <a href='logout.php?l=true' class = 'link_menu'>Logout</a>";
    echo "</div>";
  else:
    
    echo "<div  class='logar'>";
    echo "<a href='area_cliente.php' class = 'link_menu'>Perfil Cliente</a> | <a href='logout.php?l=true' class = 'link_menu'>Logout</a>";
    echo "</div>";
    
  endif;
    
endif;