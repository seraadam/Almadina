<?php
// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database connection will be here
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/visitor.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// instantiate user object
$user = new Visitor($db);

// check email existence here
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->Email = $data->Email;
$email_exists = $user->emailExists();

// files for jwt will be here
// generate json web token
include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

// generate jwt will be here

// check if email exists and if password is correct
if($email_exists && $data->Password== $user->Password){

    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "VID" => $user->VID,
           "Username" => $user->Username,
           "Email" => $user->Email
       )
    );


    // set response code
    http_response_code(200);

    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );

}

// login failed will be here
// login failed
else{

    // set response code
    http_response_code(401);

    // tell the user login failed
    echo json_encode(array("message" => "Login failed."));
}
?>
<!-- http://localhost/tiba_server/api/Login.php
{
 "Email": "abeer@gmail.com",
 "Password":"1234"
} -->
