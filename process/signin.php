<?php

require_once("../lib/configServer.php");
require_once("../lib/ConsulSQL.php");
require_once("../lib/Functions.php");

if(isset($_POST['servicio'])){
    $servicio=consultasSQL::clean_string($_POST['servicio']);
}
if(isset($_POST['email'])){
    $email=consultasSQL::clean_string($_POST['email']);
}

if(isset($_POST['password'])){
    $password=consultasSQL::clean_string(($_POST['password']));
}

if(isset($_POST['nombre'])){
    $nombre=consultasSQL::clean_string(($_POST['nombre']));
}

if(isset($_POST['cedula'])){
    $cedula=consultasSQL::clean_string(($_POST['cedula']));
}

if(isset($_POST['apellido'])){
    $apellido=consultasSQL::clean_string(($_POST['apellido']));
}

if(isset($_POST['direccion'])){
    $direccion=consultasSQL::clean_string(($_POST['direccion']));
}

if(isset($_POST['email'])){
    $email=consultasSQL::clean_string(($_POST['email']));
}

if(isset($_POST['estado'])){
    $email=consultasSQL::clean_string(($_POST['estado']));
}

if(isset($_POST['estrato_social'])){
    $estrato_social=consultasSQL::clean_string(($_POST['estrato_social']));
}

if(isset($_POST['fecha_expedicion'])){
    $fecha_expedicion=consultasSQL::clean_string(($_POST['fecha_expedicion']));
}


if(isset($_POST['fecha_ingreso'])){
    $fecha_ingreso=consultasSQL::clean_string(($_POST['fecha_ingreso']));
}

if(isset($_POST['fecha_nacimiento'])){
    $fecha_nacimiento=consultasSQL::clean_string(($_POST['fecha_nacimiento']));
}

if(isset($_POST['id_afp'])){
    $id_afp=consultasSQL::clean_string(($_POST['id_afp']));
}

if(isset($_POST['id_area'])){
    $id_area=consultasSQL::clean_string(($_POST['id_area']));
}

if(isset($_POST['id_arl'])){
    $id_arl=consultasSQL::clean_string(($_POST['id_arl']));
}

if(isset($_POST['id_departamento'])){
    $id_departamento=consultasSQL::clean_string(($_POST['id_departamento']));
}

if(isset($_POST['id_departamento_direccion'])){
    $id_departamento_direccion=consultasSQL::clean_string(($_POST['id_departamento_direccion']));
}

if(isset($_POST['id_departamento_nacimiento'])){
    $id_departamento_nacimiento=consultasSQL::clean_string(($_POST['id_departamento_nacimiento']));
}

if(isset($_POST['id_eps'])){
    $id_eps=consultasSQL::clean_string(($_POST['id_eps']));
}

if(isset($_POST['id_estado_civil'])){
    $id_estado_civil=consultasSQL::clean_string(($_POST['id_estado_civil']));
}

if(isset($_POST['id_genero'])){
    $id_genero=consultasSQL::clean_string(($_POST['id_genero']));
}

if(isset($_POST['id_lugar_direccion'])){
    $id_lugar_direccion=consultasSQL::clean_string(($_POST['id_lugar_direccion']));
}

if(isset($_POST['id_lugar_Expedicion'])){
    $id_lugar_Expedicion=consultasSQL::clean_string(($_POST['id_lugar_Expedicion']));
}

if(isset($_POST['id_lugar_nacimiento'])){
    $id_lugar_nacimiento=consultasSQL::clean_string(($_POST['id_lugar_nacimiento']));
}

if(isset($_POST['id_oficio'])){
    $id_oficio=consultasSQL::clean_string(($_POST['id_oficio']));
}

if(isset($_POST['id_pais_direccion'])){
    $id_pais_direccion=consultasSQL::clean_string(($_POST['id_pais_direccion']));
}

if(isset($_POST['id_pais_Expedicion'])){
    $id_pais_expedicion=consultasSQL::clean_string(($_POST['id_pais_Expedicion']));
}

if(isset($_POST['id_pais_nacimiento'])){
    $id_pais_nacimiento=consultasSQL::clean_string(($_POST['id_pais_nacimiento']));
}


if(isset($_POST['id_tipo_contrato'])){
    $id_tipo_contrato=consultasSQL::clean_string(($_POST['id_tipo_contrato']));
}

if(isset($_POST['id_tipo_sangre'])){
    $id_tipo_sangre=consultasSQL::clean_string(($_POST['id_tipo_sangre']));
}

if(isset($_POST['num_casillero'])){
    $num_casillero=consultasSQL::clean_string(($_POST['num_casillero']));
}

if(isset($_POST['salario'])){
    $salario=consultasSQL::clean_string(($_POST['salario']));
}

if(isset($_POST['socio'])){
    $socio=consultasSQL::clean_string(($_POST['socio']));
}

if(isset($_POST['talla_calzado'])){
    $talla_calzado=consultasSQL::clean_string(($_POST['talla_calzado']));
}

if(isset($_POST['talla_camisa'])){
    $talla_camisa=consultasSQL::clean_string(($_POST['talla_camisa']));
}

if(isset($_POST['id_talla_pantalon'])){
    $id_talla_pantalon=consultasSQL::clean_string(($_POST['id_talla_pantalon']));
}

if(isset($_POST['tel_celular'])){
    $tel_celular=consultasSQL::clean_string(($_POST['tel_celular']));
}

if(isset($_POST['tel_fijo'])){
    $tel_fijo=consultasSQL::clean_string(($_POST['tel_fijo']));
}

if(isset($_POST['id_tipo_calzado'])){
    $id_tipo_calzado=consultasSQL::clean_string(($_POST['id_tipo_calzado']));
}

if(isset($_POST['tipo_vivienda'])){
    $tipo_vivienda=consultasSQL::clean_string(($_POST['tipo_vivienda']));
}

if(isset($_POST['id_empleado'])){
    $id_empleado = consultasSQL::clean_string(($_POST['id_empleado']));
}

$data[] = array('usuario'=>$email, 'password'=>$password);
$resp = tools::conex($data, true);



function conectar($email, $password)
{
    $data[] = array('usuario'=>$email, 'password'=>$password);
    $resp = tools::conex($data, true);
    return json_encode($resp);
}

function CambiarEstadoUsuario($id, $estado)
{
    //print $id. '+++<br>';
    $data[] = array('usuario'=>$id, 'estado'=>$estado);
    //print json_encode($data). '***<br>';
    $resp = tools::CambiarEstado($data, true);
    return json_encode($resp);
}

function CamEstadoUsuario($id,$estado){
    print $id;
}

$status = $resp['status'];
$men = $resp['message'];

$return = '';
if($status == 'true'){
    session_start();
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['userid']=$resp['UserId'];
    $return = '<script language="javascript">
    document.location.href="../admin/main.php"</script>';
}else{
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';

}
//print $return;

if(isset($servicio))
{
    switch($servicio)
    {
        case 1:
            echo conectar($email, $password);
            break;
        case 2:
            
            if(isset($_POST['estado'])){
                $estado = consultasSQL::clean_string(($_POST['estado']));
            }            
            if(isset($_POST['idUser'])){
                $idUser = consultasSQL::clean_string(($_POST['idUser']));
            }
            echo CambiarEstadoUsuario($idUser, $estado);
            break; 

        case 3:
            
            echo actualizaEmpleadoPaso($nombre, $apellido, $fecha_ingreso, $fecha_nacimiento, $id_pais_nacimiento,$id_departamento, $id_lugar_nacimiento, $id_tipo_contrato, $cedula, $fecha_expedicion, $id_pais_Expedicion, $id_departamento_expedicion, $id_lugar_Expedicion,$estado, $socio, $id_area, $id_oficio, $id_estado_civil, $id_genero, $direccion, $id_pais_direccion, $id_departamento_direccion,$id_lugar_direccion, $tipo_vivienda, $estrato_social, $tel_fijo, $tel_celular, $email, $num_casillero, $id_eps , $id_afp, $id_arl, $id_tipo_sangre,$id_talla_camisa, $id_tipo_calzado, $talla_calzado, $id_empleado);
            
            break;
        default :  
            echo 'No aplica';
        break;    
    }

}

function actualizaEmpleadoPaso($nombre, $apellido, $fecha_ingreso, $fecha_nacimiento, $id_pais_nacimiento,$id_departamento, $id_lugar_nacimiento, $id_tipo_contrato, $cedula, $fecha_expedicion, $id_pais_Expedicion, $id_departamento_expedicion, $id_lugar_Expedicion,$estado, $socio, $id_area, $id_oficio, $id_estado_civil, $id_genero, $direccion, $id_pais_direccion, $id_departamento_direccion,$id_lugar_direccion, $tipo_vivienda, $estrato_social, $tel_fijo, $tel_celular, $email, $num_casillero, $id_eps , $id_afp, $id_arl, $id_tipo_sangre,$id_talla_camisa, $id_tipo_calzado, $talla_calzado, $id_empleado){
    print json_encode($id_pais_Expedicion); die("Antes de JSON");
    $empleado[] = 
    array('nombre'=>$nombre, 
    'apellido'=>$apellido,
    'fecha_ingreso'=>$fecha_ingreso, 
    'fecha_nacimiento'=>$fecha_nacimiento, 
    'id_pais_nacimiento'=>$id_pais_nacimiento,
    'id_departamento'=>$id_departamento, 
    'id_lugar_nacimiento'=>$id_lugar_nacimiento, 
    'id_tipo_contrato'=>$id_tipo_contrato, 
    'cedula'=>$cedula, 
    'fecha_expedicion'=>$fecha_expedicion, 
    'id_pais_Expedicion'=>$id_pais_Expedicion, 
    'id_departamento_expedicion'=>$id_departamento_expedicion, 
    'id_lugar_Expedicion'=>$id_lugar_Expedicion,
    'estado'=>$estado, 
    'socio'=>$socio, 
    'id_area'=>$id_area, 
    'id_oficio'=>$id_oficio, 
    'id_estado_civil'=>$id_estado_civil, 
    'id_genero'=>$id_genero, 
    'direccion'=>$direccion, 
    'id_pais_direccion'=>$id_pais_direccion, 
    'id_departamento_direccion'=>$id_departamento_direccion,
    'id_lugar_direccion'=>$id_lugar_direccion, 
    'tipo_vivienda'=>$tipo_vivienda, 
    'estrato_social'=>$estrato_social, 
    'tel_fijo'=>$tel_fijo, 
    'tel_celular'=>$tel_celular, 
    'email'=>$email, 
    'num_casillero'=>$num_casillero, 
    'id_eps'=>$id_eps, 
    'id_afp'=>$id_afp, 
    'id_arl'=>$id_arl, 
    'id_tipo_sangre'=>$id_tipo_sangre,
    'id_talla_camisa'=>$id_talla_camisa, 
    'id_tipo_calzado'=>$id_tipo_calzado, 
    'talla_calzado'=>$talla_calzado,
    'id_empleado'=>$id_empleado
    );
    $empleado_detalle = $empleado;
    
    crud_empleado::actualizar_empleado_completo($empleado_detalle);
}
?>