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

            $user->username = $data->username;
            $userArr = array();
            $userArr["body"] = array();
            
            $result = array();
            if( $user->usernameExists() ) {
               $result["present"] = "yes";
               $userArr["itemCount"] = 1;
            } else{
               $result["present"] = "no";
               $userArr["itemCount"] = 0;
            }
            array_push($userArr["body"], $result);
            echo json_encode($userArr);
        } catch (Exception $e) {
            // set response code
            http_response_code(401);
     
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