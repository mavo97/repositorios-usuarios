<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/asesor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$asesor = new Asesor($db);

 // get posted data
$data = json_decode(file_get_contents("php://input"));
  

// create the user
if(
    !empty($data->uid)
){
 	
 	$asesor->uid = $data->uid;
	$uid_exists = $asesor->uidExists();

	if($uid_exists){
		echo json_encode(array("message" => "Cuenta de correo ya se encuentra registrada."));
	}else{
		echo json_encode(array("message" => "Cuenta de correo no se encuentra registrada."));
	}
	
    
}else{
 	// set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo verificar la cuenta. Datos incompletos!"));	
   
}

?>