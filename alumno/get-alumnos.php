<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once '../config/database.php';
include_once '../objects/alumno.php';

$database = new Database();
$db = $database->getConnection();

$alumno = new Alumno($db);

$sql = $alumno->readAll();
$num = $sql->rowCount();

if($num>0){
 
    // eventoos array
    $alumnos_arr=array();
    $alumnos_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $alumno_item=array(
            "displayName" => $nombre,
            "photoURL" => $picture,
            "nocontrol" => $no_control
        );
 
        array_push($alumnos_arr["records"], $alumno_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show events data in json format
    echo json_encode($alumnos_arr);
    header('Content-Type: application/json');



    // no products found will be here
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no events found
    echo json_encode(
        array("message" => "Alumnos no encontrados.")
    );
}
?>