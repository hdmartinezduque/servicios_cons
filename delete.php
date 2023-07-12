<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once(dirname(__FILE__)."/lib/configServer.php");
require_once(dirname(__FILE__)."/lib/ConsulSQL.php");
require_once(dirname(__FILE__)."/lib/Functions.php");


$data = json_decode(file_get_contents("php://input"));
$return = crud::delete($data);
print json_encode($return);

?>