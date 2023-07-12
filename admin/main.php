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

if(isset($_GET["id"])){
    $id = $_GET["id"];
}else{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
}

if(!empty($_SESSION['userid']))
{

    switch($id){
        case 10:
            
            $menu = imp_print::slide_menu($data_menu, $data);
            $head = '<!doctype html><html lang="en">';
            $head .= '<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
            $head .= imp_print::link();
            $head .= '<title>Registro Empleados</title>';
            $head .= '</head>';
            $body_head = '<body>';
            $body_foot = '</body></html>';
            $return =  $head;
            $return .= $body_head;
            $return .= $menu;
            $return .= imp_print::contenido($data_sub_menu, '', '');
            $return .= imp_print::script_menu();
            $return .= $body_foot;
            break;
        case 11:

            //require_once("../lib/link.php");
            require_once("usuario.php");
            $menu = imp_print::slide_menu($data_menu, $data);
            $head = '<!doctype html><html lang="en">';
            $head .= '<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
            $head .= imp_print::link();
            $head .= '<title>Administracion de Usuarios</title>';
            $head .= '</head>';
            $body_head = '<body>';
            $body_foot = '</body></html>';
            $return =  $head;
            $return .= $body_head;
            $return .= $menu;
            $return .= imp_print::contenido($data_sub_menu, $consulta_usuario, '');
            $return .= imp_print::script_menu();
            $return .= $body_foot;
            break;
        case 12:

            $menu = imp_print::slide_menu($data_menu, $data);
            $head = '<!doctype html><html lang="en">';
            $head .= '<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
            $head .= imp_print::link();
            $head .= '<title>Administracion de Usuarios</title>';
            $head .= '</head>';
            $body_head = '<body>';
            $body_foot = '</body></html>';
            $return =  $head;
            $return .= $body_head;
            $return .= $menu;
            $return .= imp_print::contenido($data_sub_menu, '', '');
            $return .= imp_print::script_menu();
            $return .= $body_foot;
            break;
        case 13:

            require_once("empleados.php");
            
            $menu = imp_print::slide_menu($data_menu, $data);
            $head = '<!doctype html><html lang="en">';
            $head .= '<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
            $head .= imp_print::link();
            $head .= '<title>Administracion de Empleados</title>';
            $head .= '</head>';
            $body_head = '<body>';
            $body_foot = '</body></html>';
            $return =  $head;
            $return .= $body_head;
            $return .= $menu;
            $return .= imp_print::contenido($data_sub_menu, $consulta_empleados, '');
            $return .= imp_print::script_menu();
            $return .= $body_foot;
            break;
 
        default:
            $msg = 'Error en la conexion';
            //pasar error en FTO json
            $data[] = array('id'=>0, 'Mensaje'=>$msg);
            $return = '<script language="javascript">
            document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';
    }
}else{
    $msg = 'Error en la conexion';
    //pasar error en FTO json
    $data[] = array('id'=>0, 'Mensaje'=>$msg);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=0&msg=Datos Incorrectos"</script>';

}

print $return;

?>