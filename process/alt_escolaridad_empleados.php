<?php


require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
include("..js/validacion.js");

date_default_timezone_set('America/Bogota');
session_start(); 
$id_empleado = $_POST['cedula'];
$id = $_POST['id_empleado'];
$id_escolaridad = $_POST['id_escolaridad'];
$institucion = $_POST['institucion'];
$ultimo_ano = $_POST['ultimo_ano'];
$estado = 0;

if(empty($_SESSION['userid']))
{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
}else
{
    $campos = "
    institucion = '$institucion',
    ultimo_ano = '$ultimo_ano',
    estado = '$estado'
    ";
    if(consultasSQL::UpdateSQL("escolaridad_empleado", $campos, "id_empleado='$id' AND id_escolaridad = '$id_escolaridad'"))
    {
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
            alert("Datos Actualizados con exito");
            document.location.href="edit_escolaridad_empleado.php?id=3&msg=Registro Exitoso&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'&id_escolaridad='.$id_escolaridad.'"
        }   
        </script>
    
        </body></html>';
    }else
    {
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
            alert("No es posible insertar datos");
            document.location.href="edit_empleado.php?id=3&msg=Error actualizando datos&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'"
        }   
        </script>
        
        </body></html>';
    }

}

print $return;
?>