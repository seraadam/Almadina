<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/visitor.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare visitor object
$visitor = new Visitor($db);

// set ID property of record to read
$visitor->VID = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of visitor to be edited
$visitor->readOne();

if($visitor->VID!=null){
    // create array
    $visitor_arr = array(


      "Username" => $visitor->Username,
      "Password" => $visitor->Password,
      "NAtionality" => $visitor->NAtionality,
      "Age" => $visitor->Age,
      "Gender" => $visitor->Gender,
      "Email" => $visitor->Email,
      "PhoneNumber" => $visitor->PhoneNumber

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($visitor_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user visitor does not exist
    echo json_encode(array("message" => "visitor does not exist."));
}
?>
