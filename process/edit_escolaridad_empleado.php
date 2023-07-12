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

if(isset($_GET['identificacion']))
{
  $tabla = 'empleado';
  $campos = 'id_empleado, cedula, nombre, apellido';
  $condicion = '';
  $id_empleado = $_GET['identificacion'];
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);


  foreach($data_empleados as $rows){
      if (consultasSQL::clean_string(md5($rows['cedula']) === $id_empleado )){
        $id = $rows["id_empleado"];
        $id_empleado =  $rows['cedula'];
        $nombre = $rows['nombre'];
        $apellido = $rows['apellido'];
      }
      
  }
  
  $tabla = 'escolaridad_empleado EE INNER JOIN escolaridad E ON EE.id_escolaridad = E.id INNER JOIN empleado EM ON EE.id_empleado = EM.id_empleado';
  $condicion = 'EM.cedula = '.$id_empleado;
  $campos = 'EM.nombre, EM.apellido, EM.cedula, EM.id_empleado, EE.id_escolaridad, EE.institucion, EE.ultimo_ano';
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

  if(isset($data_empleados["status"])){
    print 'no hay registros';
  }else{
    foreach($data_empleados as $rows)
    {
      $id = $rows['id_empleado'];
      $id_empleado =  $rows['cedula'];
      $nombre =  $rows['nombre'];
      $apellido =  $rows['apellido'];
      $id_escolaridad = $rows['id_escolaridad'];
      $institucion = $rows['institucion'];
      $ult_ano = $rows['ultimo_ano'];
    }
  }


}


if(isset($_GET['identificacion']) && isset($_GET['id_escolaridad']))
{
  $action = 'alt_escolaridad_empleados.php';
}else{
  $action = 'add_escolaridad_empleados.php';
}

$form_empleado .= '<form class="row g-3" action="'.$action.'" method="POST">
<div class="col-md-4">  <!-- Datos generales del empleado -->';

if(isset($_GET['identificacion']))
{
    $form_empleado .= '<label for="inputNombres" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="nombre" name="nombre"';
    $form_empleado .= 'value = "'.$nombre.' '.$apellido.'"';
    $form_empleado .= 'readonly> </div>';  
}else{
    $form_empleado .= '
    <label for="inputcedula" class="form-label">Cedula</label>
    <input type="text" class="form-control" id="cedula" name="cedula"';
    $form_empleado .= 'required> </div>';
}

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEscolaridad" class="form-label">Escolaridad</label>
  <select class="form-control" name="id_escolaridad" id="id_escolaridad" data-live-search="false" title="Seleccione Escolaridad"required>';

if(isset($_GET['identificacion']) && isset($_GET['id_escolaridad']))
{
  $tabla = 'escolaridad';
  $campos = '*';
  $condicion = 'id = '.$_GET['id_escolaridad'];
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['escolaridad'].'</option>';
}

  $tabla = 'escolaridad';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['escolaridad'].'</option>';
  }  

} else{
    $tabla = 'escolaridad';
    $campos = '*';
    $condicion = '';
    $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
   
    foreach($data_paises as $row){
      $form_empleado .= '<option value = "'.$row['id'].'">'.$row['escolaridad'].'</option>';
    }  
} 
$form_empleado .= '</select></div>';

$form_empleado .= '
<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputinstitucion" class="form-label">Instituci&oacute;n</label>
  <input type="text" class="form-control" id="institucion" name="institucion"';
    if(isset($_GET['identificacion']) && isset($_GET['id_escolaridad']))
    {
      $form_empleado .= 'value = "'.$institucion.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '
<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputUltimoano" class="form-label">Ultimo a&ntilde;o</label>
  <input type="text" class="form-control" id="ultimo_ano" name="ultimo_ano"';
    if(isset($_GET['identificacion']) && isset($_GET['id_escolaridad']))
    {
      $form_empleado .= 'value = "'.$ult_ano.'"';
    }
$form_empleado .= 'required> </div>';
$form_empleado .= '<div><p>.</p></div>';
$form_empleado .= '<div class="col-12">';
$form_empleado .= '<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id.'">';
$form_empleado .= '<input type="hidden" id="cedula" name="cedula" value = "'.$id_empleado.'">';
if(isset($_GET['identificacion']) && isset($_GET['id_escolaridad']))
{
  $boton = 'Actualizar Escolaridad';
}else{
  $boton = 'Crear Escolaridad';
}
$form_empleado .='
<center><button type="submit" class="btn btn-primary">'.$boton.'</button></center>
</div>';


$form_empleado .='</form>';


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
    $return .= imp_print::contenido($data_sub_menu, $form_empleado, $_GET['identificacion']);
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>