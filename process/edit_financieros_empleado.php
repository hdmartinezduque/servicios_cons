<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

$nombre = '';
$apellido = '';
$numero_cuenta = '';
$tipo_transaccion = '';
$id_financiero = '';

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
  $action = 'alt_familiares_empleados.php';

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
  }

  //contador de registros
  $tabla = 'datos_financieros DF INNER JOIN empleado E';
  $campos = 'count(DF.id_financiero) CanRegn';
  $condicion = 'E.cedula ='.$id_empleado;
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
  //print json_encode($data_empleados);

  foreach($data_empleados as $row){
      $registros = $row['CanReg'];
  }

}else{
  $action = 'add_financiero_empleado.php';
}

if ($registros>0){

  $tabla = 'datos_financieros DF INNER JOIN empleado E';
  $condicion = 'E.cedula = '.$id_empleado;
  $campos = 'DF.id_financiero, DF.id_empleado, DF.numero_cuenta, DF.tipo_transaccion, E.nombre, E.apellido';
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_empleados as $rows)
  {
    $nombre = $rows['nombre'];
    $apellido = $rows['apellido'];
    $numero_cuenta = $rows['numero_cuenta'];
    $tipo_transaccion = $rows['tipo_transaccion'];
    $id_financiero = $rows['id_financiero'];
  }
}

$form_empleado .= '<form class="row g-3" action="'.$action.'" method="POST">';

if($registros>0){
    $form_empleado .= '<div class="col-md-6">
    <!-- Datos generales del empleado -->
    <label for="inputNombres" class="form-label">Nombres</label>
    <input type="text" class="form-control" id="nombre" name="nombre"';
      if(isset($_GET['id_empleado']))
      {
        $form_empleado .= 'value = "'.$nombre.'" '.$apellido.'';
      }
  $form_empleado .= 'readonly> </div>';
}

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPnacimiento" class="form-label">Entidad Financiera</label>
  <select class="form-control" name="id_entidad_financiera" id="id_entidad_financiera" data-live-search="false" title="Seleccione Entidad"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'entidad_financiera';
        $campos = '*';
        $condicion = 'id = '.$id_financiero;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion'].'</option>';
        }
      }


      $tabla = 'entidad_financiera';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion'].'</option>';
      }  

    }

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-6">
<!-- Datos generales del empleado -->
<label for="inputCuenta" class="form-label">Numero de Cuenta</label>
<input type="text" class="form-control" id="numero_cuenta" name="numero_cuenta"';
  if(isset($_GET['id_empleado']))
  {
    $form_empleado .= 'value = "'.$numero_cuenta.'"';
  }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-12">';
if($registros>0)
{
  $form_empleado .= '<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id.'">';
  $boton = 'Actualizar Financieros';
}else{
  $boton = 'Crear Cuenta';
}
$form_empleado .='
<p>.</p>
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
    $return .= imp_print::contenido($data_sub_menu, $form_empleado, $_GET['id_empleado']);
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>