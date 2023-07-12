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

    //contador de registros
    $tabla = 'datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id_empleado';
    $campos = 'count(E.id_empleado) CanReg';
    $condicion = 'E.cedula ='.$id_empleado;
    $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
    //print json_encode($data_empleados);

    foreach($data_empleados as $row){
        if($row['CanReg']==0){
            $consulta_empleados = '
            <h1><center>'.$nombre.' '.$apellido.'</center></h1>
            <center><table><tr><td>No existen datos clic para agregar <a href="edit_familiares_empleado.php?id_empleado='.$_GET['id_empleado'].'"><img src = "../img/add.png" height="16" width="16" align = "right"></a></td></tr></table></center>';
        }else{
            $tabla = 'datos_familiares DF INNER JOIN empleado E ON DF.id_empleado = E.id_empleado';
            $campos = ' E.id_empleado, DF.nombre, DF.apellido, DF.direccion, DF.telefono, DF.email, DF.contacto, DF.identificacion';
            $condicion = 'E.cedula ='.$id_empleado;
        
            $data_empleados = tools::ConsultaTablas($tabla, $campos, $condicion);
            $mensaje = 'Editar Empleado';
                    
            $consulta_empleados ='<h1><center>'.$nombre.' '.$apellido.'</center></h1>
            <table id="registro" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <th>Item</th>
            <th>Nombre Completo</th>
            <th>Direcci&oacute;n</th>
            <th>Telef&oacute;no</th>
            <th>Email</th>
            <th>Contacto</th>
            </thead>
            <tbody>';
            $add = '../process/edit_familiares_empleado.php?id=3&msg='.$mensaje.'&id_empleado='.$_GET['id_empleado'];
            $pos = 1;
            foreach($data_empleados as $row){
                
                $edicion = '../process/edit_familiares_empleado.php?id=3&msg='.$mensaje.'&id_empleado='.$_GET['id_empleado'].'&identidad_familiar='. $row['identificacion'];
                $consulta_empleados .= '<tr>';
                $consulta_empleados .= '<td>'.$pos.'<a href="'.$add.'"> <img src="../img/add.png" height="16" width="16" align = right title="Click Agregar"></a><a href="'.$edicion.'"> <img src="../img/pen.png" height="16" width="16" align = right title="Click para Editar"></a></td>';
                $consulta_empleados .= '<td>'.$row['nombre'].' '.$row['apellido'].'</td>';
                $consulta_empleados .= '<td>'.$row['direccion'].'</td>';
                $consulta_empleados .= '<td>'.$row['telefono'].'</td>';
                $consulta_empleados .= '<td>'.$row['email'].'</td>';
                $consulta_empleados .= '<td>'.$row['contacto'].'</td>';
                $consulta_empleados .= '</tr>';
                $pos++;
              }
              $consulta_empleados .='</tbody></table>';
              $consulta_empleados .= "<script>
              $(document).ready(function() {
                  $('#registro').DataTable( {
                      'pagingType': 'full_numbers'
                  } );
              } );
              </script>";

        }
    }
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
    $return .= imp_print::contenido($data_sub_menu, $consulta_empleados, $_GET['id_empleado']);
    $return .= imp_print::script_menu();
    $return .= $body_foot;
}

print $return;

?>