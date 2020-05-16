<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
include_once '../objects/alumno.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$alumno = new Alumno($db);

 // get posted data
$data = json_decode(file_get_contents("php://input"));
  

// create the user
if(
    !empty($data->uid) &&
    !empty($data->displayName) &&
    !empty($data->email) &&
    !empty($data->photoURL) &&
    !empty($data->username) &&
    !empty($data->nocontrol) &&
    !empty($data->rol)
){
 	
 	$alumno->uid = $data->uid;
	$alumno->displayName = $data->displayName;
	$alumno->email = $data->email;
	$alumno->photoURL = $data->photoURL;
	$alumno->username = $data->username;
	$alumno->nocontrol = $data->nocontrol;
	$alumno->rol = $data->rol;
	
	// create the user
if(
    !empty($data->uid)
){
 	
 	$alumno->uid = $data->uid;
	$uid_exists = $alumno->uidExists();

	if($uid_exists){
		echo json_encode(array("message" => "Cuenta de correo ya se encuentra registrada."));
	}else{
		if ($alumno->create()){
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
	
}

?>