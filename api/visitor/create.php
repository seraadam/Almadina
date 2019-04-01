<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate visitor object
include_once '../objects/visitor.php';

$database = new Database();
$db = $database->getConnection();

$visitor = new Visitor($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->Username) &&
    !empty($data->Password) &&
    !empty($data->NAtionality) &&
    !empty($data->Age) &&
    !empty($data->Gender) &&
    !empty($data->Email) &&
    !empty($data->PhoneNumber)
){

    // set visitor property values
    $visitor->Username = $data->Username;
    $visitor->Password = $data->Password;
    $visitor->NAtionality = $data->NAtionality;
    $visitor->Age = $data->Age;
    $visitor->Gender = $data->Gender;
    $visitor->Email = $data->Email;
    $visitor->PhoneNumber = $data->PhoneNumber;


    // create the visitor
    if($visitor->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "visitor was created."));
    }

    // if unable to create the visitor, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" =>$visitor));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create visitor. Data is incomplete."));
}
?>
