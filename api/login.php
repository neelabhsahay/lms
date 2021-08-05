<?php
    // required headers
    header("Access-Control-Allow-Origin: http://localhost/lms/");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // generate json web token
    include_once 'config/core.php';
    include_once 'libs/php-jwt-master/src/BeforeValidException.php';
    include_once 'libs/php-jwt-master/src/ExpiredException.php';
    include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
    include_once 'libs/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;
    
    // files needed to connect to database
    include_once 'config/db.php';
    include_once 'class/user.php';
      
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
       
    // instantiate user object
    $user = new User($db);
    
    
    // set product property values
    $user->username = $data->username;
    $password = $data->password;
    
    
    $username_exists = $user->usernameExists();
    
    // generate jwt will be here
    // check if email exists and if password is correct
    if($username_exists && password_verify($password, $user->password)){
     
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
     
        // set response code
        http_response_code(200);
     
        // generate jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
                array(
                    "message" => "Successful login.",
                    "status" => "1",
                    "data" => array(
                        "jwt" => $jwt,
                        "accountType" => $user->accountType
                    )
                )
            );
     
    } else{
        // set response code
        http_response_code(401);
     
        // tell the user login failed
        echo json_encode(array("message" => "Login failed.",
                               "status" => "0",
                               "data" => array(
                                   "username" => $user->username
                               )
                           )
                        );
    }

?> 
