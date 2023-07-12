<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
require_once("../lib/link.php");
include '../js/validacion.js';
date_default_timezone_set('America/Bogota');
$menu ='';
$consulta_empleados ='';
session_start();

$mod = 0;
$user[] = array('usuario'=>$_SESSION['userid'], 'mod'=> $mod);
//$json_menu = file_get_contents('../lib/menu.json');
$data = tools::opcion_menu($user, true);
$data_menu = tools::menu($user);
$data_sub_menu = tools::option_sub_menu($user);

//print json_encode($data);
$i=0;
foreach($data as $row){
  if($row['ID_MODULO_DETALLE'] ==3) {$editar = $row['edit'];}
}


$tabla = 'empleado as E left join empleado_retirado as ER ON E.id_empleado = ER.id_empleado';
$campos = 'E.id_empleado, E.cedula, E.nombre, E.apellido, E.fecha_ingreso, E.email';
$condicion = 'ER.fecha_retiro is null';

$data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
$mensaje = 'Editar Empleado';
$consulta_empleados ='
<table id="registro" class="table table-striped table-bordered" style="width:100%">
<thead>
  <th>Nombre Completo</th>
  <th>Cedula</th>
  <th>Fecha de Ingreso</th>
  <th>Correo electronico</th>
</thead>
<tbody>';
$add = '../process/edit_empleado.php';
foreach($data_empleados as $row){
  $edicion = '../process/edit_empleado.php?id=3&msg='.$mensaje.'&identificacion='.consultasSQL::clean_string(md5($row['cedula']));
  $consulta_empleados .= '<tr>';
  $consulta_empleados .= '<td>'.$row['nombre'].' '.$row['apellido'].'</td>';
  if($editar>0){
    $consulta_empleados .='<td>'.$row['cedula'].'<a href="#" onclick="Eliminar('.$row['id_empleado'].')"><img src="../img/trash.png" height="16" width="16" align = right title="Retirar Empleado"></a><a href="'.$add.'"><img src="../img/add.png" height="16" width="16" align = right title="Click Agregar"></a><a href="'.$edicion.'"> <img src="../img/pen.png" height="16" width="16" align = right title="Click para Editar"></a></td>';
  }else{
    $consulta_empleados .= '<td>'.$row['cedula'].'</td>';
  }
  $consulta_empleados .= '<td>'.$row['fecha_ingreso'].'</td>';
  $consulta_empleados .= '<td>'.$row['email'].'</td>';
  $consulta_empleados .= '</tr>';
}
$consulta_empleados .='</tbody></table>';
$consulta_empleados .= "<script>
$(document).ready(function() {
    $('#registro').DataTable( {
        'pagingType': 'full_numbers'
    } );
} );
</script>";
//print json_encode($data_empleados);

$menu = imp_print::slide_menu($data_menu, $data);
$head = '<!doctype html><html lang="en">';
$head .= '<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
$head .= imp_print::link();
$head .= '<title>Registro Empleados</title>';
$head .= '</head>';


$body_head = '<body>';
$body_foot = '</body></html>';

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
    $return .= imp_print::contenido($data_sub_menu, '', '');
    $return .= imp_print::script_menu();
    //$return .= $consulta_empleados;
    $return .= $body_foot;
}

print $return;

?>