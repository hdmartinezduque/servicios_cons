<?php


require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
include("..js/validacion.js");

date_default_timezone_set('America/Bogota');
session_start(); 
$id = $_POST['id'];
$id_empleado_base = $_POST['id_empleado'];
$identificacion = $_POST['identificacion'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellidos'];
$id_relacion = $_POST['id_relacion'];
$direccion = $_POST['direccion'];
$contacto =$_POST['contacto'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$id_genero = $_POST['id_genero'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$id_pais_nacimiento = $_POST['id_pais_nacimiento'];
$id_departamento_nacimiento = $_POST['id_departamento_nacimiento'];
$id_ciudad_nacimiento = $_POST['id_ciudad_nacimiento'];
if ($contacto =='on'){$contacto = 1;}else{$contacto = 0;}


$tabla = 'datos_familiares';
$campos = "identificacion";
$condicion = "id_empleado = ".$id." AND identificacion = ".$identificacion;
$verificar = consultasSQL::SelectSQL($tabla, $campos, $condicion);
$Registro = mysqli_num_rows($verificar);

if($Registro>0){
    $return = '<html>
    <body onload = "msg()">
    <script>
    function msg() {
        alert("El familiar se encuentra registrado");
        document.location.href="edit_familiares_empleado.php?id=3&msg=Registro Exitoso&id_empleado='.consultasSQL::clean_string(md5($identificacion)).'"
    }   
    </script>

    </body></html>';
}else{
    $campos = "id_familiares, id_empleado, nombre, apellido, direccion, telefono, email, contacto, genero, fecha_nacimiento, id_pais_nacimiento, id_departamento_nacimiento, id_lugar_nacimiento, identificacion";
    $valores =  "'$id_relacion', '$id', '$nombre', '$apellido', '$direccion', '$telefono', '$email', '$contacto', '$id_genero', '$fecha_nacimiento', '$id_pais_nacimiento', '$id_departamento_nacimiento', '$id_ciudad_nacimiento', '$identificacion'";
    if(consultasSQL::InsertSQL($tabla, $campos, $valores))
    {
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
          alert("Datos Insertados con exito");
          document.location.href="familiares.php?id=3&msg=Registro Exitoso&id_empleado='.consultasSQL::clean_string(md5($id_empleado_base)).'"
        }   
        </script>

        </body></html>';
    }else{
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
            alert("No es posible insertar datos");
            document.location.href="edit_empleado.php?id=3&msg=Error actualizando datos&identificacion='.consultasSQL::clean_string(md5($id_empleado_base)).'"
        }   
        </script>
        
        </body></html>';
    }
}

print $return;
?>