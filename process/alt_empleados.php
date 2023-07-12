<?php


require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
include("..js/validacion.js");

date_default_timezone_set('America/Bogota');
session_start(); 

$id = $_POST['id_empleado'];
$id_empleado =  $_POST['cedula'];
$nombre =  $_POST['nombre'];
$apellido =  $_POST['apellido'];
$direccion =  $_POST['direccion'];
$email =  $_POST['email'];
$estado =  $_POST['estado'];
$estrato_social =  $_POST['estrato_social'];
$fecha_expedicion =  $_POST['fecha_expedicion'];
$fecha_ingreso =  $_POST['fecha_ingreso'];
$fecha_nacimiento =  $_POST['fecha_nacimiento'];
$id_afp =  $_POST['id_afp'];
$id_area =  $_POST['id_area'];
$id_arl =  $_POST['id_arl'];
$id_departamento =  $_POST['id_departamento'];
$id_departamento_direccion =  $_POST['id_departamento_direccion'];
$id_departamento_nacimiento =  $_POST['id_departamento_nacimiento'];
$id_eps = $_POST['id_eps'];
$id_estado_civil = $_POST['id_estado_civil'];
$id_genero = $_POST['id_genero'];
$id_lugar_direccion = $_POST['id_lugar_direccion'];
$id_lugar_expedicion = $_POST['id_lugar_Expedicion'];
$id_lugar_nacimiento = $_POST['id_lugar_nacimiento'];
$id_oficio = $_POST['id_oficio'];
$id_pais_direccion = $_POST['id_pais_direccion'];
$id_pais_expedicion = $_POST['id_pais_Expedicion'];
$id_pais_nacimiento = $_POST['id_pais_nacimiento'];
$id_tipo_contrato = $_POST['id_tipo_contrato'];
$id_tipo_sangre = $_POST['id_tipo_sangre'];
$nombre = $_POST['nombre'];
$num_loker = $_POST['num_casillero'];
$salario = $_POST['salario'];
$socio = $_POST['socio'];
$talla_calzado = $_POST['talla_calzado'];
$talla_camisa = $_POST['id_talla_camisa'];
$talla_pantalon = $_POST['id_talla_pantalon'];
$tel_celular = $_POST['tel_celular'];
$tel_fijo = $_POST['tel_fijo'];
$tipo_calzado = $_POST['id_tipo_calzado'];
$tipo_vivienda = $_POST['tipo_vivienda'];      


$tabla = 'empleado';
$campo = "cedula";
$condicion = "cedula = ".$id_empleado.' AND id_empleado <>'.$id;

$verificar = consultasSQL::SelectSQL($tabla, $campo, $condicion);
$Registro = mysqli_num_rows($verificar);

if ($Registro==0){
    if(empty($_SESSION['userid']))
    {
        $msg = 'Error en la conexion';
        //pasar error en FTO json
        $data[] = array('id'=>0, 'Mensaje'=>$msg);
        $return = '<script language="javascript">
        document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
    }else{
        if($estado =='on'){$estado = 1;}else{$estado = 0;}
        if($socio =='on'){$socio = 1;}else{$socio = 0;}
        $campos = "
        cedula = '$id_empleado',
        fecha_expedicion = '$fecha_expedicion', 
        id_pais_expedicion = '$id_pais_expedicion',
        id_departamento = '$id_departamento',
        id_lugar_expedicion = '$id_lugar_expedicion',
        nombre = '$nombre',
        apellido = '$apellido',
        id_pais_nacimiento= '$id_pais_nacimiento', 
        id_departamento_nacimiento= '$id_departamento_nacimiento', 
        id_lugar_nacimiento = '$id_lugar_nacimiento', 
        fecha_nacimiento = '$fecha_nacimiento',
        fecha_ingreso = '$fecha_ingreso',
        id_tipo_contrato = '$id_tipo_contrato',
        estado = '$estado',
        salario = '$salario',
        socio = '$socio',
        id_area = '$id_area',
        id_oficio = '$id_oficio',
        id_estado_civil = '$id_estado_civil', 
        id_genero = '$id_genero',
        direccion = '$direccion',
        id_pais_direccion= '$id_pais_direccion', 
        id_departamento_direccion = '$id_departamento_direccion',
        id_lugar_direccion = '$id_lugar_direccion',
        tel_fijo = '$tel_fijo',
        tel_celular = '$tel_celular',
        email = '$email',
        tipo_vivienda = '$tipo_vivienda ',
        estrato_social= '$estrato_social',
        id_eps = '$id_eps',
        id_afp = '$id_afp',
        id_arl = '$id_arl',
        id_tipo_sangre = '$id_tipo_sangre',
        talla_camisa = '$talla_camisa',
        talla_pantalon = '$talla_pantalon',
        talla_calzado = '$talla_calzado',
        num_loker = '$num_loker',
        tipo_calzado = '$tipo_calzado'";

        if(consultasSQL::UpdateSQL("empleado", $campos, "id_empleado='$id'"))
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
    }
}else{
    $return = '<html>
    <body onload = "msg()">
    <script>
    function msg() {
      alert("No es posible insertar datos");
      document.location.href="edit_empleado.php?id=3&msg=Registro Repetido&identificacion='.consultasSQL::clean_string(md5($id_empleado)).'"
    }   
    </script>

    </body></html>';
}



print $return;
?>