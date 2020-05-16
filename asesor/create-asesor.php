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
    !empty($data->uid) &&
    !empty($data->displayName) &&
    !empty($data->email) &&
    !empty($data->photoURL) &&
    !empty($data->departamento) &&
    !empty($data->telefono) &&
    !empty($data->rol)
){
 	
 	$asesor->uid = $data->uid;
	$asesor->displayName = $data->displayName;
	$asesor->email = $data->email;
	$asesor->photoURL = $data->photoURL;
	$asesor->departamento = $data->departamento;
	$asesor->telefono = $data->telefono;
	$asesor->rol = $data->rol;
	$uid_exists = $asesor->uidExists();
;

	if($uid_exists){
		echo json_encode(array("message" => "Cuenta de correo ya se encuentra registrada."));
	}else{
		if ($asesor->create()){
		// set response code
	    http_response_code(200);
	 
	    // display message: user was created
	    echo json_encode(array("message" => "Cuenta creada correctamente."));
	}	else{
		 // set response code
	    http_response_code(503);
	 
	    // display message: unable to create user
	    echo json_encode(array("message" => "No se pudo crear la cuenta."));
	}	
	}
	
    
}else{
 	// set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "No se pudo verificar la cuenta. Datos incompletos!"));	
   
}
	


?>