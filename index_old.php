<!doctype html>
<html lang="en">
<?php
if (isset($_GET["id"])){
  $id = $_GET["id"];
  $msg = $_GET["msg"];
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <title>Sistema de Registro</title>
    <?php
        require_once(dirname(__FILE__)."/lib/configServer.php");
        require_once(dirname(__FILE__)."/lib/ConsulSQL.php");
        require_once(dirname(__FILE__)."/lib/Functions.php");
        require_once(dirname(__FILE__)."/lib/link.php");
    ?>
    

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="./process/signin.php" method="POST">
  <img class="mb-4" src="./img/logo.png" alt="" width="72" height="57">
  <h1 class="h3 mb-3 fw-normal">PSI - Conservarte SAS</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@cidenet.com" required>
      <label for="floatingInput">Correo Electr&oacute;nico</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      <label for="floatingPassword">Contrase&ntilde;a</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Conectarse</button>
  </form>
  <center>
    <P class="table">
      <table>
        <tr>
          <td>|<a href="recordar_pass.php"> Recordar Password</a>|</td><td><a href="nuevo_usuario.php">Usuario nuevo</a>|</td>
        </tr>
        <?php
        
        if (isset($id)){
        echo '<tr>';
        echo '<td colspan = 2><p><center>'.$msg.'</center></p></td>';  
        echo '</tr>';
        }
        ?>
      </table>
    </P>
  </center> 
</main>


    
  </body>
</html>