<?php

date_default_timezone_set('America/Bogota');
$consulta_usuario ='';
//$consulta_usuario .= '<script><script>';
$tabla = 'usuario AS u';
$campos = 'u.ID, u.USUARIO, u.EMAIL, u.NOMBRE, u.APELLIDO, u.ESTADO';
$condicion = '';

$data_usuario = tools::ConsultaTablas($tabla, $campos, $condicion);
$mensaje = 'Administrar Usuarios';
$consulta_usuario ='
<table id="registro" class="table table-striped table-bordered" style="width:100%">
<thead>
  <th>Usuario</th>
  <th>Email</th>
  <th>Nombre</th>
  <th>Apellido</th>
  <th>Estado</th>
</thead>
<tbody>';
$i=0;
foreach($data_usuario as $row){
    $i=$i+1;
    $consulta_usuario .= '<tr>';
    $consulta_usuario .= '<td>'.$row['USUARIO'].'</td>';
    $consulta_usuario .= '<td>'.$row['EMAIL'].'</td>';
    $consulta_usuario .= '<td>'.$row['NOMBRE'].'</td>';
    $consulta_usuario .= '<td>'.$row['APELLIDO'].'</td>';
    $consulta_usuario .= '<td>';
    //.$row['ESTADO'].
    $consulta_usuario .= '<input type="checkbox" name= "estado'.$i.'" id="estado'.$i.'"';
    $consulta_usuario .= "onClick=javascript:cambiarEstado('".$row['USUARIO']."','".$i."'); ";
    if($row['ESTADO']==1){
        $consulta_usuario .= 'checked '; 
    }
    if($row['ID']==1){
        $consulta_usuario .= 'disabled';
    }
    $consulta_usuario .= '>';
    //$consulta_usuario .= '<option value="'.$row['ESTADO'].'">'.$estado.'</option>';
    $consulta_usuario .= '</td>';
    $consulta_usuario .= '</tr>';
}

$consulta_usuario .='</tbody></table>';
$consulta_usuario .= "<script>
$(document).ready(function() {
    $('#registro').DataTable( {
        'pagingType': 'full_numbers'
    } );
} );
</script>";

?>