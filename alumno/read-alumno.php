<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/alumno.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare evento object
$alumno = new Alumno($db);
 
// set ID property of record to read
$alumno->uid = isset($_GET['uid']) ? $_GET['uid'] : die();
 
// read the details of event to be edited
$alumno->readOne();
 
if($alumno->displayName!=null){
    // create array
    $alumno_arr = array(
        "uid" =>  $alumno->uid,
        "displayName" => $alumno->displayName,
        "email" => $alumno->email,
        "photoURL" => $alumno->photoURL,
        "nocontrol" => $alumno->nocontrol,
        "username" => $alumno->username,
        "rol" => $alumno->rol
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($alumno_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "El alumno no existe."));
}
?>