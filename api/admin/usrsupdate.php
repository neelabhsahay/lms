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
     
            // set user property values
            $user->empId        = $data->empId;
            $user->username     = $decoded->data->username;
            $user->password     = $data->password;
            $user->email        = $data->email;
            $user->passwordType = $data->passwordType;
    
            // update the user record
            if($user->update()){
                // we need to re-generate jwt because user details might be different
                $token = array(
                   "iat" => $issued_at,
                   "exp" => $expiration_time,
                   "iss" => $issuer,
                   "data" => array(
                       "username" => $user->username,
                       "empId" => $user->empId,
                       "email" => $user->email,
                       "passwordType" => $user->passwordType,
                       "accountType" => $user->accountType
                   )
                );
                $jwt = JWT::encode($token, $key);
                 
                // set response code
                http_response_code(200);
                 
                // response in json format
                echo json_encode(
                        array(
                            "message" => "User was updated.",
                            "jwt" => $jwt
                        )
                    );
            } else {
                // set response code
                http_response_code(401);
             
                // show error message
                echo json_encode(array("message" => "Unable to update user."));
            }
        } catch (Exception $e){
            // set response code
            http_response_code(401);
    
            // show error message
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