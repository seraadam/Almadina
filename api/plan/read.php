<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/plan.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$plan = new Plan($db);


// read plans will be here

// query plans
$stmt = $plan->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // plans array
    $plans_arr=array();
    $plans_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $plan_item=array(

            "TID" => $TID,
            "VID" => $VID,
            "PID" => $PID,
            "StartDate" => $StartDate,
            "EndDate" => $EndDate,
            "Places" => $Places
        );

        array_push($plans_arr["records"], $plan_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show plans data in json format
    echo json_encode($plans_arr);
}

// no plans found will be here

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No places found.")
    );
}
