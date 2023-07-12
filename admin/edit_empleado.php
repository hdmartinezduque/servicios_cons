<?php
require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");
require_once("../lib/link.php");

date_default_timezone_set('America/Bogota');
$menu ='';
$consulta_empleados ='';
session_start();

if(isset($_GET['identificacion']))
{
  $mod = 3;
}else{
  $mod = 0;
}


$user[] = array('usuario'=>$_SESSION['userid'], 'mod'=> $mod);

$data = tools::opcion_menu($user, true);
$data_menu = tools::menu($user);
$data_sub_menu = tools::option_sub_menu($user);

if(isset($_GET['identificacion']))
{
  $tabla = 'empleado';
  $campos = 'cedula';
  $condicion = '';
  $id_empleado = $_GET['identificacion'];
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
          $nombre =  $rows['nombre'];
          $apellido =  $rows['apellido'];
          $direccion =  $rows['direccion'];
          $email =  $rows['email'];
          $estado =  $rows['estado'];
          $estrato_social =  $rows['estrato_social'];
          $fecha_expedicion =  $rows['fecha_expedicion'];
          $fecha_ingreso =  $rows['fecha_ingreso'];
          $fecha_nacimiento =  $rows['fecha_nacimiento'];
          $id_afp =  $rows['id_afp'];
          $id_area =  $rows['id_area'];
          $id_arl =  $rows['id_arl'];
          $id_departamento =  $rows['id_departamento'];
          $id_departamento_direccion =  $rows['id_departamento_direccion'];
          $id_departamento_nacimiento =  $rows['id_departamento_nacimiento'];
          $id_eps = $rows['id_eps'];
          $id_estado_civil = $rows['id_estado_civil'];
          $id_genero = $rows['id_genero'];
          $id_lugar_direccion = $rows['id_lugar_direccion'];
          $id_lugar_expedicion = $rows['id_lugar_expedicion'];
          $id_lugar_nacimiento = $rows['id_lugar_nacimiento'];
          $id_oficio = $rows['id_oficio'];
          $id_pais_direccion = $rows['id_pais_direccion'];
          $id_pais_expedicion = $rows['id_pais_expedicion'];
          $id_pais_nacimiento = $rows['id_pais_nacimiento'];
          $id_tipo_contrato = $rows['id_tipo_contrato'];
          $id_tipo_sangre = $rows['id_tipo_sangre'];
          $nombre = $rows['nombre'];
          $num_loker = $rows['num_loker'];
          $salario = $rows['salario'];
          $socio = $rows['socio'];
          $talla_calzado = $rows['talla_calzado'];
          $talla_camisa = $rows['talla_camisa'];
          $talla_pantalon = $rows['talla_pantalon'];
          $tel_celular = $rows['tel_celular'];
          $tel_fijo = $rows['tel_fijo'];
          $tipo_calzado = $rows['tipo_calzado'];
          $tipo_vivienda = $rows['tipo_vivienda'];      
  }

}
if(isset($_GET['identificacion']))
{
  $action = 'alt_empleados.php';
}else{
  $action = 'add_empleados.php';
}


//$talla_pantalon = $talla_pantalon+6;
//$consulta_empleados = json_encode($data_empleados);
//$consulta_empleados .= '<br>Direccion '.$direccion;
$js = '<script src = "../js/empleado_crud.js"></script>';
//$form_empleado .= '<form class="row g-3" action="'.$action.'" method="POST">
$form_empleado .= '<form class="row g-3">

<h1><center>'.$nombre.' '.$apellido.'</center></h1>

<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputNombres" class="form-label">Nombres</label>
  <input type="text" class="form-control" id="nombre" name="nombre"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$nombre.'"';
    }
$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputApellido" class="form-label">Apellidos</label>
  <input type="text" class="form-control" id="apellido" name="apellido"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$apellido.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="DateIngreso" class="form-label">Fecha Ingreso</label>
  <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$fecha_ingreso.'"';
    }

$form_empleado .= 'required> </div>';


$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputNombres" class="form-label">Fecha Nacimiento</label>
  <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$fecha_nacimiento.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPnacimiento" class="form-label">Pais Nacimiento</label>
  <select class="form-control" name="id_pais_nacimiento" id="id_pais_nacimiento" data-live-search="false" title="Seleccione el pais"required>';

  if(isset($_GET['identificacion']))
    {
      $tabla = 'paises';
      $campos = '*';
      $condicion = 'id = '.$id_pais_nacimiento;
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }

      $tabla = 'paises';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }  

    }else{
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
  <label for="inputDnacimiento" class="form-label">Departamento Nacimiento</label>
  <select class="form-control" name="id_departamento_nacimiento" id="id_departamento_nacimiento" data-live-search="false" title="Seleccione el Departamento"required>';


if(isset($_GET['identificacion']))
{
  $tabla = 'departamentos';
  $campos = '*';
  $condicion = 'id = '.$id_departamento_nacimiento;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'departamentos';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}else{
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
  <label for="inputCnacimiento" class="form-label">Ciudad Nacimiento</label>
  <select class="form-control" name="id_lugar_nacimiento" id="id_lugar_nacimiento" data-live-search="false" title="Seleccione la ciudad"required>';

if(isset($_GET['identificacion']))
{
  $tabla = 'municipios';
  $campos = '*';
  $condicion = 'id = '.$id_lugar_nacimiento;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'municipios';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}else{
  $tabla = 'municipios';
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
  <label for="inputCnacimiento" class="form-label">Tipo Contrato</label>
  <select class="form-control" name="id_tipo_contrato" id="id_tipo_contrato" data-live-search="false" title="Seleccione el contrato"required>';

if(isset($_GET['identificacion']))
{
  $tabla = 'tipo_contrato';
  $campos = '*';
  $condicion = 'id = '.$id_tipo_contrato;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_contrato'].'</option>';
  }

  $tabla = 'tipo_contrato';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_contrato'].'</option>';
  }  

}else{
  $tabla = 'tipo_contrato';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_contrato'].'</option>';
  }  
}

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputcedula" class="form-label">Cedula</label>
  <input type="text" class="form-control" id="cedula" name="cedula"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$id_empleado.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputcedula" class="form-label">Salario</label>
  <input type="text" class="form-control" id="salario" name="salario"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$salario.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="DateIngreso" class="form-label">Fecha Expedici&oacute;n</label>
  <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$fecha_ingreso.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputPExpedicion" class="form-label">Pais Expedicion</label>
  <select class="form-control" name="id_pais_Expedicion" id="id_pais_Expedicion" data-live-search="false" title="Seleccione el pais"required>';

  if(isset($_GET['identificacion']))
    {
      $tabla = 'paises';
      $campos = '*';
      $condicion = 'id = '.$id_pais_nacimiento;
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }

      $tabla = 'paises';
      $campos = '*';
      $condicion = '';
      $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
     
      foreach($data_paises as $row){
        $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
      }  

    }else{
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
  <label for="inputDExpedicion" class="form-label">Departamento Expedicion</label>
  <select class="form-control" name="id_departamento" id="id_departamento" data-live-search="false" title="Seleccione el Departamento"required>';


if(isset($_GET['identificacion']))
{
  $tabla = 'departamentos';
  $campos = '*';
  $condicion = 'id = '.$id_departamento_nacimiento;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'departamentos';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}else{
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
  <label for="inputCExpedicion" class="form-label">Ciudad Expedicion</label>
  <select class="form-control" name="id_lugar_Expedicion" id="id_lugar_Expedicion" data-live-search="false" title="Seleccione la ciudad"required>';

if(isset($_GET['identificacion']))
{
  $tabla = 'municipios';
  $campos = '*';
  $condicion = 'id = '.$id_lugar_nacimiento;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'municipios';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}else{
  $tabla = 'municipios';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  
}

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-1">
<div class="checkbox">
  <label for="inputEstado" class="form-label">Estado</label>
  <input type="checkbox" checked data-toggle="toggle" id = "estado" name = "estado">
</div>
</div>';

$form_empleado .= '<div class="col-md-1">
<div class="checkbox">
  <label for="inputSocio" class="form-label">Socio</label>
  <input type="checkbox" checked data-toggle="toggle" id = "socio" name = "socio">
</div>
</div>';


$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputArea" class="form-label">&Aacute;rea</label>
  <select class="form-control" name="id_area" id="id_area" data-live-search="false" title="Seleccione el &Aacute;rea"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'area';
  $campos = '*';
  $condicion = 'id = '.$id_area;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['area'].'</option>';
  }

  $tabla = 'area';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['area'].'</option>';
  }  

}else{
  $tabla = 'area';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['area'].'</option>';
  }  
}

$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputArea" class="form-label">Oficio</label>
  <select class="form-control" name="id_oficio" id="id_oficio" data-live-search="false" title="Seleccione el Oficio"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'oficio';
  $campos = '*';
  $condicion = 'id = '.$id_oficio;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['oficio'].'</option>';
  }

  $tabla = 'oficio';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['oficio'].'</option>';
  }  

}else{
  $tabla = 'oficio';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['oficio'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';



$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEstadoCivil" class="form-label">Estado Civil</label>
  <select class="form-control" name="id_estado_civil" id="id_estado_civil" data-live-search="false" title="Seleccione Estado Civil"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'estado_civil';
  $campos = '*';
  $condicion = 'id = '.$id_estado_civil;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['estado'].'</option>';
  }

  $tabla = 'estado_civil';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['estado'].'</option>';
  }  

} else{
  $tabla = 'estado_civil';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['estado'].'</option>';
  }  
} 
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputGenero" class="form-label">Genero</label>
  <select class="form-control" name="id_genero" id="id_genero" data-live-search="false" title="Seleccione Genero"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'genero';
  $campos = '*';
  $condicion = 'id = '.$id_genero;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['genero'].'</option>';
  }

  $tabla = 'genero';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['genero'].'</option>';
  }  

}else{
  $tabla = 'genero';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['genero'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-5">
  <!-- Datos generales del empleado -->
  <label for="inputdireccion" class="form-label">Direcci&oacute;n Residencia</label>
  <input type="text" class="form-control" id="direccion" name="direccion"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$direccion.'"';
    }

$form_empleado .= 'required> </div>';


$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputPais" class="form-label">Pais Residencia</label>
  <select class="form-control" name="id_pais_direccion" id="id_pais_direccion" data-live-search="false" title="Seleccione Pais"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'paises';
  $campos = '*';
  $condicion = 'id = '.$id_pais_direccion;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'paises';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}else{
  $tabla = 'paises';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputDepResidencia" class="form-label">Departamento Residencia</label>
  <select class="form-control" name="id_departamento_direccion" id="id_departamento_direccion" data-live-search="false" title="Seleccione Departamento"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'departamentos';
  $campos = '*';
  $condicion = 'id = '.$id_departamento_direccion;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'departamentos';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

} else{
  $tabla = 'departamentos';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  
} 
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputCiuResidencia" class="form-label">Ciudad Residencia</label>
  <select class="form-control" name="id_lugar_direccion" id="id_lugar_direccion" data-live-search="false" title="Seleccione Ciudad"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'municipios';
  $campos = '*';
  $condicion = 'id = '.$id_lugar_direccion;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }

  $tabla = 'municipios';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  

}  else{
  $tabla = 'municipios';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['nombre'].'</option>';
  }  
}
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputTipoVivienda" class="form-label">Tipo Vivienda</label>
  <select class="form-control" name="tipo_vivienda" id="tipo_vivienda" data-live-search="false" title="Seleccione Tipo Vivienda"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'tipo_vivienda';
  $campos = '*';
  $condicion = 'id = '.$tipo_vivienda;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_vivienda'].'</option>';
  }

  $tabla = 'tipo_vivienda';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_vivienda'].'</option>';
  }  

}  else{
  $tabla = 'tipo_vivienda';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['tipo_vivienda'].'</option>';
  }  
}
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputEstrato" class="form-label">Estrato</label>
  <input type="number" min="0" max="8" class="form-control" id="estrato_social" name="estrato_social"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$estrato_social.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEstrato" class="form-label">Telefono Fijo</label>
  <input type="text" class="form-control" id="tel_fijo" name="tel_fijo"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$tel_fijo.'"';
    }

$form_empleado .= 'required> </div>';


$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEstrato" class="form-label">Telefono Celular</label>
  <input type="text" class="form-control" id="tel_celular" name="tel_celular"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$tel_celular.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputEmail" class="form-label">Correo Electr&oacute;nico</label>
  <input type="text" class="form-control" id="email" name="email"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$email.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputLoker" class="form-label">Casillero</label>
  <input type="number" min="0" max="8" class="form-control" id="num_casillero" name="num_casillero"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$num_loker.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEps" class="form-label">EPS</label>
  <select class="form-control" name="id_eps" id="id_eps" data-live-search="false" title="Seleccione Ciudad"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'entidad_salud';
  $campos = '*';
  $condicion = 'id = '.$id_eps;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_salud'].'</option>';
  }

  $tabla = 'entidad_salud';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_salud'].'</option>';
  }  

}  else{
  $tabla = 'entidad_salud';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_salud'].'</option>';
  }  
}
$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputAfp" class="form-label">AFP</label>
  <select class="form-control" name="id_afp" id="id_afp" data-live-search="false" title="Seleccione AFP"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'entidad_afp';
  $campos = '*';
  $condicion = 'id = '.$id_afp;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_afp'].'</option>';
  }

  $tabla = 'entidad_afp';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_afp'].'</option>';
  }  

}else{
  $tabla = 'entidad_afp';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_afp'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-4">
  <!-- Datos generales del empleado -->
  <label for="inputAfp" class="form-label">ARL</label>
  <select class="form-control" name="id_arl" id="id_arl" data-live-search="false" title="Seleccione ARL"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'entidad_arl';
  $campos = '*';
  $condicion = 'id = '.$id_arl;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_arl'].'</option>';
  }

  $tabla = 'entidad_arl';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_arl'].'</option>';
  }  

}else{
  $tabla = 'entidad_arl';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['entidad_arl'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputSangre" class="form-label">Sangre</label>
  <select class="form-control" name="id_tipo_sangre" id="id_tipo_sangre" data-live-search="false" title="Seleccione Tipo Sangre"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'tipo_sangre';
  $campos = '*';
  $condicion = 'id = '.$id_tipo_sangre;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);

  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion_sangre'].'</option>';
  }

  $tabla = 'tipo_sangre';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion_sangre'].'</option>';
  }  

}else{
  $tabla = 'tipo_sangre';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['descripcion_sangre'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputCamisa" class="form-label">Camisa</label>
  <select class="form-control" name="id_talla_camisa" id="id_talla_camisa" data-live-search="false" title="Seleccione Talla Camisa"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'talla_camisa';
  $campos = '*';
  $condicion = 'id = '.$talla_camisa;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  foreach($data_paises as $row){
    //$form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_camisa'].'</option>';
  }

  $tabla = 'talla_camisa';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_camisa'].'</option>';
  }  

}else{
  $tabla = 'talla_camisa';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_camisa'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';

//print $talla_pantalon;
$form_empleado .= '<div class="col-md-2">
  <!-- Datos generales del empleado -->
  <label for="inputpantalon" class="form-label">Pantal&oacute;n</label>
  <select class="form-control" name="id_talla_pantalon" id="id_talla_camisa" data-live-search="false" title="Seleccione Talla Pantalon"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'talla_pantalon';
  $campos = '*';
  $condicion = 'id = '.$talla_pantalon;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  //print json_encode($data_paises);
  foreach($data_paises as $row){
    //$form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_pantalon'].'</option>';
  }

  $tabla = 'talla_pantalon';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_pantalon'].'</option>';
  }  

}else{
  $tabla = 'talla_pantalon';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['talla_pantalon'].'</option>';
  }  
}  
$form_empleado .= '</select></div>';


$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputcalzado" class="form-label">Tipo Calzado</label>
  <select class="form-control" name="id_tipo_calzado" id="id_tipo_calzado" data-live-search="false" title="Seleccione Calzado"required>';

  if(isset($_GET['identificacion']))
{
  $tabla = 'tipo_calzado';
  $campos = '*';
  $condicion = 'id = '.$tipo_calzado;
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
  //print json_encode($data_paises);
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['calzado'].'</option>';
  }

  $tabla = 'tipo_calzado';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['calzado'].'</option>';
  }  

}else{
  $tabla = 'tipo_calzado';
  $campos = '*';
  $condicion = '';
  $data_paises = tools::ConsultaTablas($tabla, $campos, $condicion);
 
  foreach($data_paises as $row){
    $form_empleado .= '<option value = "'.$row['id'].'">'.$row['calzado'].'</option>';
  }  

}  
$form_empleado .= '</select></div>';

$form_empleado .= '<div class="col-md-3">
  <!-- Datos generales del empleado -->
  <label for="inputEstrato" class="form-label">Talla Calzado</label>
  <input type="number" min="0" max="46" class="form-control" id="talla_calzado" name="talla_calzado"';
    if(isset($_GET['identificacion']))
    {
      $form_empleado .= 'value = "'.$talla_calzado.'"';
    }

$form_empleado .= 'required> </div>';

$form_empleado .= '<div class="col-12">';
if(isset($_GET['identificacion']))
{
  $form_empleado .= '<input type="hidden" id="id_empleado" name="id_empleado" value = "'.$id.'">';
  $boton = 'Actualizar Empleado';
}else{
  $boton = 'Crear Empleado';
}
$form_empleado .='
<center><input type="button" class="btn btn-primary"  id= "actualizar" value = '.$boton.' onClick=javascript:actualizarEmpleado();></center>
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
    //$return .= $js;
    $return .= $body_head;
    $url = 'id=3&msg=Editar Empleado&id_empleado='.$_GET['identificacion'];
    $return .= $menu;
    $return .= imp_print::contenido($data_sub_menu, $form_empleado, $url);
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>

