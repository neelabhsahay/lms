<?php
    // required headers
    header("Access-Control-Allow-Origin: http://localhost/lms/");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // required to encode json web token
    include_once '../config/core.php';
    include_once '../libs/php-jwt-master/src/BeforeValidException.php';
    include_once '../libs/php-jwt-master/src/ExpiredException.php';
    include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
    include_once '../libs/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;
     
    // files needed to connect to database
    include_once '../config/db.php';
    include_once '../class/user.php';

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    // instantiate user object
    $user = new User($db);

    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
 
    // if jwt is not empty
    if($jwt){
 
        // if decode succeed, show user details
        try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            $user->username = $decoded->data->username;

            if( $user->delete() ) {
                
               // set response code
                http_response_code(200);
             
                // display message: user was created
                echo json_encode(array("message" => "User record was deleted.",
                                       "status" => "passed"));
                // display message: unable to create user
                $insertResponse = array();
                $insertResponse["message"] = "User record was deleted.";
                $insertResponse["status"] = "passed";
                $insertResponse["data"] = array();
                $e = array(
                    "username" => $user->username
                ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse); 
            } else{
                http_response_code(404);
                $insertResponse = array();
                $insertResponse["message"] = "No record found.";
                $insertResponse["status"] = "failed";
                $insertResponse["data"] = array();
                $e = array(
                    "username" => $user->username
                ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse);
            }
        } catch (Exception $e) {
            // set response code
            http_response_code(403);
     
            // tell the user access denied  & show error message
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    } else {
        // set response code
        http_response_code(401);
     
        // tell the user access denied
        echo json_encode(array("message" => "Access denied."));
    }
?>        