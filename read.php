<?php
require_once(dirname(__FILE__)."/lib/configServer.php");
require_once(dirname(__FILE__)."/lib/ConsulSQL.php");
require_once(dirname(__FILE__)."/lib/Functions.php");

header("Content-Type:application/json");


if (isset($_GET['customer_id']) && $_GET['customer_id']!="") 
{

	$user = $_GET['customer_id'];
	$query = ejecutarSQL::consultar("SELECT * FROM `USUARIO` WHERE USUARIO='$user'");
	$Regnum = mysqli_num_rows($query);
    if($Regnum)
    {

        //$result = mysqli_query($con,$query);
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $customerData['id'] = $row['ID'];
            $customerData['usuario'] = $row['USUARIO'];
            $customerData['email'] = $row['EMAIL'];
            $customerData['nombre'] = $row['NOMBRE'];
            $customerData['apellido'] = $row['APELLIDO'];
            $customerData['password'] = $row['PASSWORD'];
            $customerData['estado'] = $row['ESTADO'];
        
            $response["status"] = "true";
            $response["message"] = "Customer Details";
            $response["customers"] = $customerData;
        
        }


    } else {
        $response["status"] = "false";
        $response["message"] = "There is no data to show, code does not exist!";
    }
    
}else{
    $response["status"] = "false";
    $response["message"] = "No customer(s) found!";
}
echo json_encode($response); exit;

?>