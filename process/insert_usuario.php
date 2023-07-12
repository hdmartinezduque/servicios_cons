<?php

include '../lib/configServer.php';
include '../lib/consulSQL.php';
include '../lib/Functions.php';
$estado =0;
$email=consultasSQL::clean_string($_POST['email']);
$nombre=consultasSQL::clean_string($_POST['nombre']);
$apellido=consultasSQL::clean_string($_POST['apellido']);
$password=consultasSQL::clean_string($_POST['password']);
$data[] = array('usuario'=>$email,'email'=>$email, 'nombre'=>$nombre, 'apellido'=>$apellido, 'password'=>$password, 'estado'=>$estado);


$verificar= ejecutarSQL::consultar("SELECT * FROM usuario WHERE email='$email'");
$verificaltotal = mysqli_num_rows($verificar);
if ($verificaltotal>0){
    $return = '<script language="javascript">
    document.location.href="../index.php?id=1&Error=usuario ya existe"</script>';
}else{
    //consultasSQL::InsertSQL("usuario", "USUARIO, EMAIL, NOMBRE, APELLIDO, PASSWORD, ESTADO", "'$email','$email','$nombre', '$apellido','$password', '$estado'");
    $resp = crud::create($data, true);
    $return = '<script language="javascript">
    document.location.href="../index.php?id=1&msg=Datos Correctos"</script>';
}
print $return;

?>