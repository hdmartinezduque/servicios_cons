<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

$nombre = '';
$apellido = '';
$direccion = '';
$telefono = '';
$email = '';
$genero = '';
$fecha_nacimiento = '';
$id_pais_nacimiento ='';
$id_departamento_nacimiento = '';
$id_lugar_nacimiento = '';
$id_familiares = '';

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
  $tabla = 'datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id_empleado';
  $campos = 'count(E.id_empleado) CanReg';
  $condicion = 'E.cedula ='.$id_empleado. ' AND DF.identificacion = "'.$_GET['identidad_familiar']. '"';
  if(isset($_GET['identidad_familiar'])){
    $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
  }
 
  //print $_GET['identidad_familiar'];
  
  //print json_encode($data_empleados);

  foreach($data_empleados as $row){
      $registros = $row['CanReg'];
  }

}else{
  $action = 'add_familiares.php';
  
}

if ($registros>0){

  $tabla = 'datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id_empleado';
  $condicion = 'E.cedula = '.$id_empleado;
  $campos = 'E.id_empleado, DF.nombre, DF.apellido, DF.direccion, DF.telefono, DF.email, DF.contacto, DF.genero, DF.fecha_nacimiento, DF.id_pais_nacimiento, DF.id_departamento_nacimiento, DF.id_lugar_nacimiento, DF.id_familiares, DF.identificacion';
  $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_empleados as $rows)
  {
    $nombre = $rows['nombre'];
    $apellido = $rows['apellido'];
    $direccion = $rows['direccion'];
    $telefono = $rows['telefono'];
    $email = $rows['email'];
    $contacto = $rows['contacto'];
    $genero = $rows['genero'];
    $fecha_nacimiento = $rows['fecha_nacimiento'];
    $id_pais_nacimiento = $rows['id_pais_nacimiento'];
    $id_departamento_nacimiento = $rows['id_departamento_nacimiento'];
    $id_lugar_nacimiento = $rows['id_lugar_nacimiento'];
    $id_familiares = $rows['id_familiares'];
    $identificacion = $rows['identificacion'];
  }
}

$form_empleado .= '<form class="row g-3" action="'.$action.'" method="POST">';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputNombres" class="form-label">Identificaci&oacute;n</label>
  <input type="text" class="form-control" id="identificacion" name="identificacion"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$identificacion.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputNombres" class="form-label">Nombres</label>
  <input type="text" class="form-control" id="nombre" name="nombre"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$nombre.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputApellidos" class="form-label">Apellidos</label>
  <input type="text" class="form-control" id="apellidos" name="apellidos"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$apellido.'"';
    }
$form_empleado .= 'required> </div>';


$form_empleado .= '<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputGenero" class="form-label">Relaci&oacute;n</label>
  <select class="form-control" name="id_relacion" id="id_relacion" data-live-search="false" title="Seleccione Relacion"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'familiares';
        $campos = '*';
        $condicion = 'id = '.$id_familiares;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion'].'</option>';
        }
      }


      $tabla = 'familiares';
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
  <label for="inputdireccion" class="form-label">Direcci&oacute;n</label>
  <input type="text" class="form-control" id="direccion" name="direccion"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$direccion.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-1">
<div class="checkbox">
  <label for="inputContacto" class="form-label">Contacto</label>
  <input type="checkbox" checked data-toggle="toggle" id = "contacto" name = "contacto">
</div>
</div>';


$form_empleado .= '<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputEmail" class="form-label">Email</label>
  <input type="text" class="form-control" id="email" name="email"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$email.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputTelefono" class="form-label">Telef&oacute;fono</label>
  <input type="text" class="form-control" id="telefono" name="telefono"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$telefono.'"';
    }
$form_empleado .= 'required> </div>';




$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputGenero" class="form-label">Genero</label>
  <select class="form-control" name="id_genero" id="id_genero" data-live-search="false" title="Seleccione Genero"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'genero';
        $campos = '*';
        $condicion = 'id = '.$genero;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['genero'].'</option>';
        }
      }


      $tabla = 'genero';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['genero'].'</option>';
      }  

    }

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="DateNacimiento" class="form-label">Fecha Nacimiento</label>
  <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"';
    if(isset($_GET['id_empleado']))
    {
      $form_empleado .= 'value = "'.$fecha_nacimiento.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPnacimiento" class="form-label">Pais Nacimiento</label>
  <select class="form-control" name="id_pais_nacimiento" id="id_pais_nacimiento" data-live-search="false" title="Seleccione Pais"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'paises';
        $campos = '*';
        $condicion = 'id = '.$id_pais_nacimiento;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
        }
      }


      $tabla = 'paises';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }  

    }

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPnacimiento" class="form-label">Departamento Nacimiento</label>
  <select class="form-control" name="id_departamento_nacimiento" id="id_departamento_nacimiento" data-live-search="false" title="Seleccione Departamento"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'departamentos';
        $campos = '*';
        $condicion = 'id = '.$id_departamento_nacimiento;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
        }
      }


      $tabla = 'departamentos';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }  

    }

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPnacimiento" class="form-label">Ciudad Nacimiento</label>
  <select class="form-control" name="id_ciudad_nacimiento" id="id_ciudad_nacimiento" data-live-search="false" title="Seleccione Ciudad"required>';

  if(isset($_GET['id_empleado']))
    {
      if($registros>0){
        $tabla = 'municipios';
        $campos = '*';
        $condicion = 'id = '.$id_lugar_nacimiento;
        $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  
        foreach($data_paises as $row){
          $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
        }
      }


      $tabla = 'municipios';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }  

    }

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-12">';
$form_empleado .= '<input type="hidden" id="id" name="id" value = "'.$id.'">';
$form_empleado .= '<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id_empleado.'">';
if($registros>0)
{
  
  $boton = 'Actualizar Familiares';
}else{
  $boton = 'Crear Familiar Empleado';
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