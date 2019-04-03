<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/place.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare place object
$place = new Place($db);

// set ID property of record to read
$place->Category= isset($_GET['category']) ? $_GET['category'] : die();

// read the details of place to be edited
$place->readCategory();

if($place->Category!=null){
    // create array
    $place_arr = array(

      "PID" => $place->PID,
      "Description" => html_entity_decode($place->Description),
      "Title" => $place->Title,
      "lat" => $place->lat,
      "lang" => $place->lang,
      "image_name" => $place->image_name

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($place_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user place does not exist
    echo json_encode(array("message" => "place does not exist."));
}
?>
