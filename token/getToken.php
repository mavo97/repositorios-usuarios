<?php

require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/api-repos');
$dotenv->load();


// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/token.php';

// prepare evento object
$token = new Token();

$token->token = getenv('TOKEN');

if($token->token!=null){
    // create array
    $token_arr = array(
        "token" =>  $token->token
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($token_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "El token esta vacío."));
}

?>