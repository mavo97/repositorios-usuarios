<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/asesor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare evento object
$asesor = new Asesor($db);
 
// set ID property of record to read
$asesor->uid = isset($_GET['uid']) ? $_GET['uid'] : die();
 
// read the details of event to be edited
$asesor->readOne();
 
if($asesor->displayName!=null){
    // create array
    $asesor_arr = array(
        "uid" =>  $asesor->uid,
        "displayName" => $asesor->displayName,
        "email" => $asesor->email,
        "photoURL" => $asesor->photoURL,
        "departamento" => $asesor->departamento,
        "telefono" => $asesor->telefono,
        "rol" => $asesor->rol
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($asesor_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "El asesor no existe."));
}
?>