<!doctype html>
<html lang="en">

<script>
  function conec(){
    var email = document.getElementById('email').value;
    var pass = document.getElementById('password').value;
    var parametros = "servicio=1&email="+email+"&password="+pass;
    var url = '../servicios/process/signin.php';
    const ajax_request = new XMLHttpRequest();
    ajax_request.open( "POST", url, true );
    ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax_request.send( parametros );
    ajax_request.responseType = 'text';
    ajax_request.onload =() =>{
      if(ajax_request.readyState === ajax_request.DONE){
        if(ajax_request.status == 200){
          var res = ajax_request.responseText;
          var resarray = res.split(':');
          var status = resarray[1].split(',');
          if(status[0]=='"true"'){
            document.location.href="../servicios/admin/main.php?id=10";
          }else{
            document.getElementById("user_valid").innerHTML = "Error: Usuario y contraseña";
            //alert('Error: Usuario y contraseña');
          }
        }
      }
    };
 
  }

</script> 


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

    <button class="w-100 btn btn-lg btn-primary" type="button" value = "Conectarse" onclick="conec()">Conectarse</button>
  </form>
  <center>
    <P class="table">
      <table>
        <tr>
          <td align="center">|<a href="recordar_pass.php"> Recordar Password</a>|</td><td align="center"><a href="nuevo_usuario.php">Usuario nuevo</a>|</td>
        </tr>
      </table>
      <label id ="user_valid"></label>
    </P>
  </center> 
</main>


    
  </body>
</html>