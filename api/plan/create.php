<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate plan object
include_once '../objects/plan.php';

$database = new Database();
$db = $database->getConnection();

$plan = new Plan($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->VID) &&
    !empty($data->PID) &&
    !empty($data->Date)
){

    // set plan property values

    $plan->VID = $data->VID;
    $plan->PID = $data->PID;
    $plan->Date = $data->Date;


    // create the plan
    if($plan->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "plan was created."));
    }

    // if unable to create the plan, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => $plan));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "400"));
}
// {
// "VID":"4",
// "PID":"9",
// "Date":"2019-09-4"
// }
?>
