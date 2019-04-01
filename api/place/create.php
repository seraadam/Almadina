<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate place object
include_once '../objects/place.php';

$database = new Database();
$db = $database->getConnection();

$place = new Place($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
ini_set('display_errors', 'On');
error_reporting(E_ALL);
// make sure data is not empty
if(
    // !empty($data->PID) &&
    !empty($data->Category) &&
    !empty($data->Description) &&
    !empty($data->Location) &&
    !empty($data->image_name) &&
    !empty($data->Title)
){

    // set place property values
    // $place->PID = $data->PID;
    $place->Category = $data->Category;
    $place->Description = $data->Description;
    $place->Location = $data->Location;
    $place->image_name = $data->image_name;
    $place->Title = $data->Title;


    // create the place
    if($place->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("201" => "place was created."));
    }

    // if unable to create the place, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("503" => $data));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" =>$data));
}
?>
