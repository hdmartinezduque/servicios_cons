<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

date_default_timezone_set('America/Bogota');
$menu ='';
session_start();
$mod = 4;
$user[] = array('usuario'=>$_SESSION['userid'], 'mod'=> $mod);
//$json_menu = file_get_contents('../lib/menu.json');
$data = tools::opcion_menu($user, true);
$data_menu = tools::menu($user);
$data_sub_menu = tools::option_sub_menu($user);

//print json_encode($data);

$tabla = 'turno';
$campos = 'count(id) as Cant';
$condicion = '';
$data_turnos = tools::ConsultaTablas($tabla, $campos, $condicion);

foreach($data_turnos as $row){
    $regCant = $row["Cant"];
}
if($regCan ==0){
    $consulta_empleados = '<center><table><tr><td>No existen datos clic para agregar <a href="edit_turnos.php"><img src = "../img/add.png" height="16" width="16" align = "right"></a></td></tr></table></center>';
}

$menu = imp_print::slide_menu($data_menu, $data);
$head = '<!doctype html><html lang="en">';
$head .= '<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
$head .= imp_print::link();
$head .= '<title>Registro Empleados</title>';
$head .= '</head>';


$body_head = '<body>';
$body_foot = '</body></html>';



if(empty($_SESSION['userid']))
{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
}else{
    $return =  $head;
    $return .= $body_head;
    $return .= $menu;
    $return .= imp_print::contenido($data_sub_menu, $consulta_empleados, '');
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>