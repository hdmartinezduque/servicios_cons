<?php

date_default_timezone_set('America/Bogota');
$menu ='';
$consulta_empleados ='';
session_start();
print $_SESSION['userid'];
if(empty($_SESSION['userid']))
{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
}else{
    $return = '<script language="javascript">
    document.location.href="../admin/bienestar.php?id=3"</script>';

}
print $return;

?>