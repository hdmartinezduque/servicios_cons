<?php
class crud
{
    public static function create($parameters,  $web = false)
    {
       
       
    if(!empty($parameters))
    {
        if ($web){

            foreach($parameters as $rows)
            {
                $usuario = $rows['usuario'];
                $email = $rows['email'];
                $nombre = $rows['nombre'];
                $apellido = $rows['apellido'];
                $password = $rows['password'];
                $estado = $rows['estado'];
            }

        }else{

            foreach($parameters as $rows)
            {
                $usuario = $rows->usuario;
                $email = $rows->email;
                $nombre = $rows->nombre;
                $apellido = $rows->apellido;
                $password = $rows->password;
                $estado = $rows->estado;
            }
        }
        $pass_cryp = tools::CrearPass($password);
        consultasSQL::InsertSQL("usuario", "USUARIO, EMAIL, NOMBRE, APELLIDO, PASSWORD, ESTADO","'$usuario','$email','$nombre','$apellido','$pass_cryp','$estado'");

        $response["status"] = "true";
        $response["message"] = "User has been registering successfully";
    }else{
        $response["status"] = "false";
        $response["message"] = "Error, try later";
    }
    return $response; 
    }

    public static function update($parameters)
    {

        foreach ($parameters as $row)
        {
            $usuario = $row->usuario;
            $email = $row->email;
            $nombre = $row->nombre;
            $apellido = $row->apellido;
            $password = $row->password;
            $estado = $row->estado;
            $pass_cryp = tools::CrearPass($password);
            consultasSQL::UpdateSQL("usuario", "EMAIL='$email', NOMBRE='$nombre', APELLIDO='$apellido', PASSWORD='$pass_cryp', ESTADO='$estado'","USUARIO='$usuario'" );        
        }
        $response["status"] = "true";
        $response["message"] = "User has been updating successfully";
        return $response;
    }

    public static function delete($parameters)
    {
        foreach ($parameters as $row)
        {
            $usuario = $row->usuario;
            $email = $row->email;
            $nombre = $row->nombre;
            $apellido = $row->apellido;
            $password = $row->password;
            $estado = $row->estado;
            consultasSQL::DeleteSQL('usuario', "USUARIO='".$usuario."'");
        }
        $response["status"] = "true";
        $response["message"] = "User has been deleting successfully";
        return $response;
   
    }
}

class crud_empleado
{
    public static function actualizar_empleado_completo($datos_empleado)
    {
        
        //print json_encode($datos_empleado). '<br>';
        foreach ($datos_empleado as $row)
        {
            $id_empleado = $row['id_empleado'];
            $cedula =  $row['cedula'];
            $nombre =  $row['nombre'];
            $apellido =  $row['apellido'];
            $direccion =  $row['direccion'];
            $email =  $row['email'];
            $estado =  $row['estado'];
            $estrato_social =  $row['estrato_social'];
            $fecha_expedicion =  $row['fecha_expedicion'];
            $fecha_ingreso =  $row['fecha_ingreso'];
            $fecha_nacimiento =  $row['fecha_nacimiento'];
            $id_afp =  $row['id_afp'];
            $id_area =  $row['id_area'];
            $id_arl =  $row['id_arl'];
            $id_departamento =  $row['id_departamento'];
            $id_departamento_direccion =  $row['id_departamento_direccion'];
            $id_departamento_nacimiento =  $row['id_departamento_nacimiento'];
            $id_eps = $row['id_eps'];
            $id_estado_civil = $row['id_estado_civil'];
            $id_genero = $row['id_genero'];
            $id_lugar_direccion = $row['id_lugar_direccion'];
            $id_lugar_expedicion = $row['id_lugar_Expedicion'];
            $id_lugar_nacimiento = $row['id_lugar_nacimiento'];
            $id_oficio = $row['id_oficio'];
            $id_pais_direccion = $row['id_pais_direccion'];
            $id_pais_expedicion = $row['id_pais_Expedicion'];
            $id_pais_nacimiento = $row['id_pais_nacimiento'];
            $id_tipo_contrato = $row['id_tipo_contrato'];
            $id_tipo_sangre = $row['id_tipo_sangre'];
            $num_loker = $row['num_casillero'];
            $salario = $row['salario'];
            $socio = $row['socio'];
            $talla_calzado = $row['talla_calzado'];
            $talla_camisa = $row['id_talla_camisa'];
            $talla_pantalon = $row['id_talla_pantalon'];
            $tel_celular = $row['tel_celular'];
            $tel_fijo = $row['tel_fijo'];
            $tipo_calzado = $row['id_tipo_calzado'];
            $tipo_vivienda = $row['tipo_vivienda'];
        }
        $campos = "
        cedula = '$cedula',
        fecha_expedicion = '$fecha_expedicion', 
        id_pais_expedicion = '$id_pais_expedicion',
        id_departamento = '$id_departamento',
        id_lugar_expedicion = '$id_lugar_expedicion',
        nombre = '$nombre',
        apellido = '$apellido',
        id_pais_nacimiento= '$id_pais_nacimiento', 
        id_departamento_nacimiento= '$id_departamento_nacimiento', 
        id_lugar_nacimiento = '$id_lugar_nacimiento', 
        fecha_nacimiento = '$fecha_nacimiento',
        fecha_ingreso = '$fecha_ingreso',
        id_tipo_contrato = '$id_tipo_contrato',
        estado = '$estado',
        salario = '$salario',
        socio = '$socio',
        id_area = '$id_area',
        id_oficio = '$id_oficio',
        id_estado_civil = '$id_estado_civil', 
        id_genero = '$id_genero',
        direccion = '$direccion',
        id_pais_direccion= '$id_pais_direccion', 
        id_departamento_direccion = '$id_departamento_direccion',
        id_lugar_direccion = '$id_lugar_direccion',
        tel_fijo = '$tel_fijo',
        tel_celular = '$tel_celular',
        email = '$email',
        tipo_vivienda = '$tipo_vivienda ',
        estrato_social= '$estrato_social',
        id_eps = '$id_eps',
        id_afp = '$id_afp',
        id_arl = '$id_arl',
        id_tipo_sangre = '$id_tipo_sangre',
        talla_camisa = '$talla_camisa',
        talla_pantalon = '$talla_pantalon',
        talla_calzado = '$talla_calzado',
        num_loker = '$num_loker',
        tipo_calzado = '$tipo_calzado'";
      
        if(consultasSQL::UpdateSQL("empleado", $campos, "id_empleado='$id_empleado'"))
        {
            $response["status"] = "true";
            $response["message"] = "Record has been successfully";
            $response["UserId"] = $id_empleado;
        }else{
            $response["status"] = "false";
            $response["message"] = "Error conexion";
        }
        print json_encode($response);
        //die('*****'.$id_empleado.'*****');
        return $response;
    }
}

class conect
{
    public function __construct($usuario, $password)
    {
        $this->usuario = $usuario;
        $this->password = $password;
        
        return $this;
    }
}

class tools
{

    public static function CrearPass($pass)
    {
        $hash = password_hash($pass, PASSWORD_DEFAULT, [15]);
        return $hash;
    }

    public static function verificarPass($password ,$hash)
    {
        return password_verify($password, $hash);
        //        $rep = password_verify($password, $hash)
        //return $resp;
    }

    public static function CambiarEstado($data){
        foreach($data as $rows)
        {
            $usuario = $rows['usuario'];
            $estado = $rows['estado'];
        }
        consultasSQL::UpdateSQL("usuario","estado='$estado'" ,"USUARIO='$usuario'" );
        $response["status"] = true;
        $response["message"] = "User has been updated successfully";
        $response["usuario"] = $usuario;
        return $response;
        //consultasSQL::UpdateSQL("usuario", "EMAIL='$email', NOMBRE='$nombre', APELLIDO='$apellido', PASSWORD='$pass_cryp', ESTADO='$estado'","USUARIO='$usuario'" );        
    }


    public static function conex($data, $web = false)
    {
        //$data = json_encode($data);
        //print $data;
        if ($web){
            foreach($data as $rows)
            {
                $user = $rows['usuario'];
                $password = $rows['password'];
            }

        }else{
            foreach($data as $rows)
            {
                $user = $rows->usuario;
                $password = $rows->password;
            }
        }

        $query = ejecutarSQL::consultar("SELECT ID,PASSWORD FROM `USUARIO` WHERE USUARIO='$user' AND ESTADO = 1");
        $Regnum = mysqli_num_rows($query);
        
        if($Regnum)
        {
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                $userData['id']=$row['ID'];
                $userData['password'] = $row['PASSWORD'];
            }
    
            $hash = tools::CrearPass($password);
    
            if (tools::verificarPass($password, $userData['password']))
            {
                $response["status"] = "true";
                $response["message"] = "User has been conecting successfully";
                $response["UserId"] = $userData['id'];

            }else
            {
                $response["status"] = "false";
                $response["message"] = "Error conexion";
            }
        }else{
            $response["status"] = "false";
            $response["message"] = "no user register";
        }

        return $response;
    }

public static function opcion_menu($data, $web = false)
{
    $response = '';
    if ($web){

        foreach($data as $rows)
        {
            $user = $rows['usuario'];
        }
        $query = ejecutarSQL::consultar("SELECT U.USUARIO, U.NOMBRE, U.APELLIDO, M.DESCRIPCION AS MENU, MD.DESCRIPCION AS OPCION, MD.PROM, ID_MODULO_DETALLE, P.edit 
        FROM PERMISO AS P INNER JOIN MODULO_DETALLE AS MD ON P.ID_MODULO_DETALLE = MD.ID INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
        WHERE U.ID='$user' ORDER BY MD.orden");

    }else{
        foreach($data as $rows)
        {
            $user = $rows->usuario;
        }
        $query = ejecutarSQL::consultar("SELECT U.USUARIO, U.NOMBRE, U.APELLIDO, M.DESCRIPCION AS MENU, MD.DESCRIPCION AS OPCION, MD.PROM, ID_MODULO_DETALLE, P.edit 
        FROM PERMISO AS P INNER JOIN MODULO_DETALLE AS MD ON P.ID_MODULO_DETALLE = MD.ID INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
        WHERE U.USUARIO='$user' ORDER BY MD.orden");
    }

    $Regnum = mysqli_num_rows($query);
    $response = array();
    $i=0;
    if($Regnum)
    {
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $response[$i] = $row;
            $i++;
        }
    }else{
        $response[] = array('DESCRIPCION'=>'CERRAR', "PROM"=>"../process/logout.php");
        //$response["status"] = "false";
        //$response["message"] = "no found records";
    }

    return $response;
}

public static function menu($data)
{
    
    foreach($data as $rows)
    {
        $user = $rows['usuario'];
    }

    $query = ejecutarSQL::consultar("SELECT DISTINCTROW M.DESCRIPCION, M.PROM FROM PERMISO P INNER JOIN MODULO_DETALLE MD ON P.ID_MODULO_DETALLE = MD.ID  INNER JOIN MODULO AS M ON MD.ID_MODULO = M.ID  INNER JOIN USUARIO AS U ON P.ID_USUARIO = U.ID 
    WHERE U.ID='$user' ORDER BY M.orden");
    $Regnum = mysqli_num_rows($query);
    $i=0;

    if($Regnum)
    {
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $response[$i] = $row;
            $i++;
        }
    }else{
        $response[] = array('DESCRIPCION'=>'CERRAR', "PROM"=>"../process/logout.php");
        //$response["status"] = "false";
        //$response["message"] = "no found records";
    }

    return $response;
}

public static function option_sub_menu($data){
    foreach($data as $rows){
        $user = $rows['usuario'];
        $mod = $rows['mod'];
    }
    $query = ejecutarSQL::consultar("SELECT U.USUARIO, MD.DESCRIPCION AS MODULO_DETALLE, SMD.DESCRIPCION AS SUB_MODULO_DETALLE, SMD.PROM 
    FROM PERMISO_SUB PS INNER JOIN USUARIO U ON PS.ID_USUARIO = U.ID INNER JOIN MODULO_DETALLE MD ON PS.ID_MODULO_DETALLE = MD.ID INNER JOIN SUB_MODULO_DETALLE SMD ON ID_SUB_MODULO_DETALLE = SMD.ID 
    WHERE U.ID = '".$user."' AND MD.ID_MODULO = '".$mod."' AND SMD.ESTADO = 0");
    $Regnum = mysqli_num_rows($query);
    $i=0;
    if($Regnum)
    {
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $response[$i] = $row;
            $i++;
        }
    }else{
        $response[] = array('USUARIO'=>$user, 'MODULO_DETALLE'=> "CERRAR", "SUB_MODULO_DETALLE"=>"CERRAR", "PROM"=>"../process/logout.php");
        //$response["USUARIO"] = $user;
        //$response["MODULO_DETALLE"] = "CERRAR";
        //$response["SUB_MODULO_DETALLE"] = "CERRAR";
        //$response["PROM"] = "../logout.php";

    }    
    return $response;
}

public static function ConsultaTablas($tabla, $campos, $condicion)   
{
    $query = consultasSQL::SelectSQL($tabla, $campos, $condicion);
    $Regnum = mysqli_num_rows($query);
    
    $i=0;
    if($Regnum)
    {
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            //if ($i==0){$response["status"] = "true";}
            $response[$i] = $row;
            $i++;
        }
    }else{
        $response["status"] = "false";
        $response["message"] = "no found records";
    }    
    return $response;
}   

}

class imp_print
{
    public static function sub_menu($data_sub_menu){
        $sub_menu = '<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="../admin/empleados">Empleados</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">';
            foreach($data_sub_menu as $rows){
              $sub_menu .= '<li class="nav-item">';
                $sub_menu .= '<a class="nav-link active" aria-current="page" href="'.$rows["PROM"].'">'.$rows["SUB_MODULO_DETALLE"].'</a>';
              $sub_menu .= '</li>';
              }
            $sub_menu .='</ul></div></div></nav>';
          return $sub_menu;
    }

    public static function menu($data_menu, $data)
    {
  
        $menu ='<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
          <a class="navbar-brand" href="../process/logout.php">Cerrar</a>
          <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                  <ul class="navbar-nav">';
        foreach($data_menu as $row)
        {
            $menu .= '<li class="nav-item dropup">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">'.$row['DESCRIPCION'].'</a>
      
                <ul class="dropdown-menu" aria-labelledby="dropdown10">';  
            foreach($data as $row_opcion){
              if($row_opcion['MENU'] === $row['DESCRIPCION'])
              {
                $menu .= '<li><a class="dropdown-item" href="../admin/'. $row_opcion['PROM']. '"> '.$row_opcion['OPCION'].' </a></li>';
              }
            }
            $menu .= '</ul></li>';
      }

        $menu .='</ul></div></div></nav>';
        return $menu;
    }

    public static function slide_menu($data_menu, $data)
    {
        
        $slide_menu = '';
        $i = 0;

        $slide_menu .='		<div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4 pt-5">
              <a href="#" class="img logo rounded-circle mb-5" style="background-image: url(../img/logo.png);"></a>
        <ul class="list-unstyled components mb-5">';

        foreach($data_menu as $row)
        {
            if($i==0)
            {
                $slide_menu .= '<li class="active">';
            }else
            {
                $slide_menu .='<li>';
            } 
            $slide_menu .= '<a href="#homeSubmenu_'.str_replace(' ','_',$row['DESCRIPCION']).'" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">'.$row['DESCRIPCION'].'</a>';
                $slide_menu .= '<ul class="collapse list-unstyled" id="homeSubmenu_'.str_replace(' ','_',$row['DESCRIPCION']).'">';
                foreach($data as $row_opcion){
                    if($row_opcion['MENU'] == $row['DESCRIPCION'])
                    {
                        $slide_menu .= '<li><a href="'.$row_opcion['PROM'].'">'.$row_opcion['OPCION'].'</a></li>';
                    }
                }
                $slide_menu .='</ul></li>';
                $i++;
        }
        $slide_menu .= '</ul></div></nav>';

        return $slide_menu;

    }

    public static function contenido($menu_contenido, $print, $id_empleado)
    {
        $redirect = '';
        if(strlen($id_empleado)>0){
            $redirect = '?id_empleado='.$id_empleado;
        }
        $contenido = '<div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
            </button>';

            $contenido .= '<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>';
        $i = 0;
        foreach($menu_contenido as $rows){
            $contenido .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">';

                if ($i == 0)
                {
                    $contenido .='<li class="nav-item active">';
                }else{
                    $contenido .='<li class="nav-item">';
                }
                $contenido .='<a class="nav-link" href="'.$rows["PROM"].$redirect.'">'.$rows["SUB_MODULO_DETALLE"].'</a>';
                $contenido .='</li>';
                $contenido .='</ul>';
            $contenido .='</div>';
        }
            


            $contenido .= '</div></nav>';
            $contenido .= $print;

        return $contenido;
    }



    public static function script_menu()
    {
        $script_menu ='
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        ';

        return $script_menu;
    }

    public static function link()
    {
        $link_menu ='<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">';
        $link_menu .='<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
        $link_menu .='<link rel="stylesheet" href="../css/style.css">';
        $link_menu .= '<script src="../js/validacion.js"></script>';
        return $link_menu;
    }

    public static function footer(){
        $footer ='<div class="footer">
        <p>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
        </p>
        </div>';
        return $footer;
    }
      

}


?>