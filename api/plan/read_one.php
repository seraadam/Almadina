<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/plan.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare plan object
$plan = new Plan($db);

// set ID property of record to read
$plan->TID = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of plan to be edited
$plan->readOne();

if($plan->TID!=null){
    // create array
    $plan_arr = array(

      "VID" => $plan->VID,
      "PID" => $plan->PID,
      "StartDate" => $plan->StartDate,
      "EndDate" => $plan->EndDate,
      "places" => $plan->places

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($plan_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user plan does not exist
    echo json_encode(array("message" => "plan does not exist."));
}
?>
