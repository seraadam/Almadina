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
    !empty($data->lat) &&
    !empty($data->lang) &&
    !empty($data->image_name) &&
    !empty($data->Title)&&
    !empty($data->Start) &&
    !empty($data->End)
){

    // set place property values
    // $place->PID = $data->PID;
    $place->Category = $data->Category;
    $place->Description = $data->Description;
    $place->lat = $data->lat;
    $place->lang = $data->lang;
    $place->image_name = $data->image_name;
    $place->Title = $data->Title;
    $place->Start = $data->Start;
    $place->End = $data->End;
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

//
// {
// "Category":"Historical",
// "Title":"Medina museum (Railway Station)",
// "lat":"24.4619371",
// "lang":"39.6009011",
// "image_name":"https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImages/HijazRailroadLine.jpg",
// "Description":"The Medina museum in Hejaz railway Station receives a lot of visitors and researchers. It is one of the prominent tourist destinations and a cultural front for Medina region, which is characterized by the abundance of archeological and Islamic sites. The museum includes the railway station buildings; a museum in the railway repair shop that displays the history of Hejaz Railway station; a market for craftsmen; a shop; a traditional café; and a restauran",
//"End":"2019-09-4",
// "Start":"2019-09-4"
//}
// {
// "Category":"Historical",
// "Title":"Tabuk station",
// "lat":"28.4043008",
// "lang":"36.614686",
// "image_name":"https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImages/taboukstation.jpg",
// "Description":"It is one of the main stations in the Hejaz railway. It has a unique building style. The first train reached it in 1906 CE. It is located in the heart of Tabuk city. It consists of a group of buildings that were built in a straight line parallel to the railway path. It was restored several times and it is currently in a good constructional condition. The total area of the station is 80,000 m2",
//"End":"2019-09-4",
// "Start":"2019-09-4"
// }
?>
