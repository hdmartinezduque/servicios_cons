<?php


require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
include("..js/validacion.js");

date_default_timezone_set('America/Bogota');
session_start(); 

$id = $_POST['id_empleado'];
$fecha_retiro =  $_POST['fecha_retiro'];
$fecha_ingreso =  $_POST['fecha_ingreso'];
$motivo =  $_POST['motivo'];
$id_empleado =  $_POST['cedula'];
if(empty($_SESSION['userid']))
{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
}else{
    $tabla = "empleado_retirado";
    $campos = "id_empleado, fecha_ingreso, fecha_retiro, motivo_retiro";
    $valores = "'$id','$fecha_ingreso', '$fecha_retiro', '$motivo'";

    if(consultasSQL::InsertSQL($tabla, $campos, $valores))
    {
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
          alert("Datos Actualizados con exito");
          document.location.href="edit_empleado.php?id=3&msg=Registro Exitoso&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'"
        }   
        </script>

        </body></html>';
    }
    print $return;

}
?>