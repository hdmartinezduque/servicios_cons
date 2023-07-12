<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'lib/configServer.php';
include 'lib/consulSQL.php';
include 'lib/functions.php';


$data = json_decode(file_get_contents("php://input"));
$return = crud::update($data);
print json_encode($return);

?>