<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/place.php';

// instantiate database and place object
$database = new Database();
$db = $database->getConnection();

// initialize object
$place = new Place($db);

// read places will be here

// query places
$stmt = $place->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // places array
    $places_arr=array();
    $places_arr["category"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $place_item=array(

            "PID" => $PID,
            "Category" => $Category,
            "Description" => html_entity_decode($Description),
            "Title" => $Title,
            "lat" => $lat,
            "lang" => $lang,
            "image_name" => $image_name
        );

        array_push($places_arr["category"], $place_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show places data in json format
    echo json_encode($places_arr);
}

// no places found will be here
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No places found.")
    );
}
