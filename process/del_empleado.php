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

if(isset($_GET['id']))
{
  $action = 'retiro_empleado.php';

  $tabla = 'empleado';
  $campos = '*';
  $condicion = 'id_empleado = '.$_GET['id'];

  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

/*
  foreach($data_empleados as $rows){
      if (consultasSQL::clean_string(md5($rows['cedula']) === $id_empleado )){
          $id_empleado =  $rows['cedula'];
      }
      
  }
  $condicion = 'cedula = '.$id_empleado;
  $campos = '*';
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
*/
  foreach($data_empleados as $rows)
  {
      $id = $rows['id_empleado'];
      $id_empleado =  $rows['cedula'];
      $nombre = $rows['nombre'];
      $apellido = $rows['apellido'];
      $fecha_ingreso = $rows['fecha_ingreso'];

  }

}

$form_empleado .= '<h1><center>'.$nombre.' '.$apellido.'</center></h1> <form class="row g-3" action="'.$action.'" method="POST">';
$form_empleado .= '<div class="col-md-6">
  <!-- Datos generales del empleado -->
  <label for="DateIngreso" class="form-label">Fecha Ingreso</label>
  <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso"';
    if(isset($_GET['id']))
    {
      $form_empleado .= 'value = "'.$fecha_ingreso.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-6">
  <!-- Datos generales del empleado -->
  <label for="DateIngreso" class="form-label">Fecha Retiro</label>
  <input type="date" class="form-control" id="fecha_retiro" name="fecha_retiro"';

$form_empleado .= 'required> </div>';




// Agregar *** Motivos parametros

$form_empleado .= '<div class="col-md-6">
  <!-- Datos generales del empleado -->
  <label for="inputRetiro" class="form-label">Causa de retiro</label>
  <input type="textarea" class="form-control" id="motivo" name="motivo"';

$form_empleado .= 'required> </div>';
// Agregar causal de retiro

$form_empleado .= '<div class="col-md-6">
  <!-- Datos generales del empleado -->
  <label for="inputMretiro" class="form-label">Motivo Retiro</label>
  <select class="form-control" name="id_motivo_retiro" id="id_motivo_retiro" data-live-search="false" title="Seleccione Motivo"required>';

  if(isset($_GET['id_empleado']))
    {
      $tabla = 'empleado_retirado ER Inner Join motivo_retiro MR On ER.id_motivo_retiro = MR.id';
      $campos = 'MR.id, MR.motivo';
      $condicion = 'ER.id_empleado = '.$_GET['id_empleado'];
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['motivo'].'</option>';
      }
    }


    $tabla = 'motivo_retiro';
    $campos = '*';
    $condicion = '';
    $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
    foreach($data_paises as $row){
      $form_empleado .= '<option value = "'.$row['id'].'">'.$row['motivo'].'</option>';
    }  

$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-12">';
$boton = 'Retirar Empleado';
$form_empleado .='
<p>.</p>
<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id.'">
<input type="hidden" id="cedula" name="cedula" value = "'.$id_empleado.'">
<center><button type="submit" class="btn btn-primary">'.$boton.'</button></center>
</div>';

$form_empleado .= '</form>';

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
    $return .= imp_print::contenido($data_sub_menu, $form_empleado, $_GET['id_empleado']);
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>