<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

date_default_timezone_set('America/Bogota');
$menu ='';
session_start();
$mod = 3;
$user[] = array('usuario'=>$_SESSION['userid'], 'mod'=> $mod);
//$json_menu = file_get_contents('../lib/menu.json');
$data = tools::opcion_menu($user, true);
$data_menu = tools::menu($user);
$data_sub_menu = tools::option_sub_menu($user);

//print json_encode($data);

if(isset($_GET['id_empleado']))
{
  $action = 'consulta_marcacion_empleado.php';

  $tabla = 'empleado';
  $campos = 'cedula';
  $condicion = '';
  $id_empleado = $_GET['id_empleado'];
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);


  foreach($data_empleados as $rows){
      if (consultasSQL::clean_string(md5($rows['cedula']) === $id_empleado )){
          $id_empleado =  $rows['cedula'];
      }
      
  }
  $condicion = 'cedula = '.$id_empleado;
  $campos = '*';
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_empleados as $rows)
  {
      $id = $rows['id_empleado'];
      $id_empleado =  $rows['cedula'];
      $nombre = $rows['nombre'];
      $apellido = $rows['apellido'];
  }

}

$form_empleado .= '<h1><center>'.$nombre.' '.$apellido.'</center></h1> <form class="row g-3" action="'.$action.'" method="POST">';
$form_empleado .= '<div class="col-md-5">';
$form_empleado .= '<label for="inputGenero" class="form-label">Año</label>
<select class="form-control" name="id_ano" id="id_ano" data-live-search="false" title="Seleccione Año"required>';
if(isset($_GET['id_empleado']))
{
    $tabla = 'marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado';
    $campos = 'Distinct Year(M.fecha_ingreso_real) As ano';
    $condicion = 'E.cedula = '.$id_empleado;  

    $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

    foreach($data_paises as $row){
        if(isset($row['ano'])){$form_empleado .= '<option value = "'.$row['ano'].'">'.$row['ano'].'</option>';}
      
    }

}

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-5">';
$form_empleado .= '<label for="inputGenero" class="form-label">Semana</label>
<select class="form-control" name="id_semana" id="id_semana" data-live-search="false" title="Seleccione Semana"required>';
if(isset($_GET['id_empleado']))
{
    $campos = 'Distinct WEEKOFYEAR(M.fecha_ingreso_real) As Semana';
    $tabla = 'marcaciones M INNER JOIN empleado E ON M.id_empleado = E.id_empleado';
    if(isset($_GET['id_ano'])){$condicion = 'E.cedula = '.$id_empleado.' AND Year(M.fecha_ingreso_real)='.$id_ano.''; }
    else{$condicion = 'E.cedula = '.$id_empleado;}
    $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
    foreach($data_paises as $row){
      if(isset($row['Semana'])){ $form_empleado .= '<option value = "'.$row['Semana'].'">'.$row['Semana'].'</option>';}
    }

}

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-12">';
$boton = 'Consultar Marcaci&oacute;n';
$form_empleado .='
<p>.</p>
<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id.'">
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