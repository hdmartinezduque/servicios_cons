<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

date_default_timezone_set('America/Bogota');
$menu ='';
session_start();
$mod = 0;
$user[] = array('usuario'=>$_SESSION['userid'], 'mod'=> $mod);
//$json_menu = file_get_contents('../lib/menu.json');
$data = tools::opcion_menu($user, true);
$data_menu = tools::menu($user);
$data_sub_menu = tools::option_sub_menu($user);

//print json_encode($data);
$Object = new DateTime();

$tabla = 'marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado';
$campos = 'E.id_empleado, E.cedula, E.nombre, E.apellido, M.id_empleado, (ELT(WEEKDAY(fecha_ingreso_real) + 1, "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo")) As Dia, WEEKOFYEAR(M.fecha_ingreso_real) As Semana, Year(M.fecha_ingreso_real) As ano ,M.fecha_ingreso_real, M.fecha_salida_real, M.fecha_ingreso_ajuste, M.fecha_salida_ajuste
, timestampdiff(SECOND,M.fecha_ingreso_real,M.fecha_salida_real) / 3600 AS Horas';
$condicion = 'E.id_empleado = '.$_POST['id_empleado'].' AND WEEKOFYEAR(M.fecha_ingreso_real) = '.$_POST["id_semana"].' AND Year(M.fecha_ingreso_real)='.$_POST["id_ano"];
$data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

foreach($data_empleados as $row){
    $nombre = $row['nombre'];
    $apellido = $row['apellido'];
    $cedula = $row['cedula'];
    $acu_horas = $row['Horas']+$acu_horas;
    $ano = $row['ano'];
    $semana = $row['Semana'];
}

$enc_tabla .='';
$enc_tabla .='<table id="enc" class="table table-striped table-bordered" style="width:100%"><thead>
<tr><td>C&eacute;dula '.$cedula.'</td><tr>
<tr><td>Nombre Completo '.$nombre.' '.$apellido.'</td></tr>
<tr><td>Cantidad Horas '.round($acu_horas,2).'</td><tr>
<tr><td>Periodo '.$ano.'-'.$semana.'</td></tr></thead></table>';


$consulta_empleados ='
<table id="registro" class="table table-striped table-bordered" style="width:100%">
<thead>
  <th>Dia</th>
  <th>Hora Ingreso</th>
  <th>Hora Salida</th>
  <th>Total Horas</th>
</thead>
<tbody>';

foreach($data_empleados as $row){
    $consulta_empleados .= '<tr>';
    $consulta_empleados .= '<td>'.$row['Dia'].'</td>';
    $consulta_empleados .= '<td>'.date($row['fecha_ingreso_real']).'</td>';
    $consulta_empleados .= '<td>'.$row['fecha_salida_real'].'</td>';
    $consulta_empleados .= '<td>'.$row['Horas'].'</td>';
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
    $return .= imp_print::contenido($data_sub_menu, $enc_tabla.$consulta_empleados, '');
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>