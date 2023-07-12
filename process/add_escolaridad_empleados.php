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

$tabla = 'escolaridad_empleado';
$campos = "id_empleado";
$condicion = "id_empleado = ".$id." AND id_escolaridad = ".$id_escolaridad;
$verificar = consultasSQL::SelectSQL($tabla, $campos, $condicion);
$Registro = mysqli_num_rows($verificar);

if($Registro>0){
    $return = '<html>
    <body onload = "msg()">
    <script>
    function msg() {
        alert("El registro ya exite para el empleado");
        document.location.href="edit_escolaridad_empleado.php?id=3&msg=Registro Exitoso&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'&id_escolaridad='.$id_escolaridad.'"
    }   
    </script>

    </body></html>';
}else{
    $campos = "id_escolaridad, id_empleado, institucion, ultimo_ano, estado";
    $valores =  "'$id_escolaridad', '$id', '$institucion', '$ultimo_ano', '$estado'";
    if(consultasSQL::InsertSQL($tabla, $campos, $valores))
    {
        $return = '<html>
        <body onload = "msg()">
        <script>
        function msg() {
          alert("Datos Insertados con exito");
          document.location.href="edit_escolaridad_empleado.php?id=3&msg=Registro Exitoso&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'&id_escolaridad='.$id_escolaridad.'"
        }   
        </script>

        </body></html>';
    }else{
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