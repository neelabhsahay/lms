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
    $emp = new Employee($db);
     
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
     
    // if jwt is not empty
    if($jwt){
        // if decode succeed, show user details
        try {   
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            // set user property values
            $emp->firstName = $data->firstName;
            $emp->middleName = $data->middleName;
            $emp->lastName = $data->lastName;
            $emp->email = $data->email;
            $emp->contact = $data->contact;
            $emp->location = $data->location;
            $emp->dateOfBirth = $data->dateOfBirth;
            $emp->dateOfJoin = $data->dateOfJoin;
            $emp->empType = $data->empType;
            $emp->empRole = $data->empRole;
            $emp->manager = $data->manager;
            $emp->departmentId = $data->departmentId;
            $emp->empStatus = $data->empStatus;
            $emp->empId = $data->empId;
     

            // update the user record
            if( !empty($emp->empId) &&
                $emp->update()){
                // regenerate jwt will be here
                // set response code
                http_response_code(200);
             
                // display message: user was created
                $insertResponse = array();
                $insertResponse["message"] = "Employee record was updated.";
                $insertResponse["status"] = "passed";
                $insertResponse["data"] = array();
                $e = array(
                        "empId"      => $emp->empId,
                    ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse);
            } else {
                // set response code
                http_response_code(400);
             
                // show error message
                $insertResponse = array();
                $insertResponse["message"] = "Employee record not updated.";
                $insertResponse["status"] = "failed";
                $insertResponse["data"] = array();
                $e = array(
                        "empId"      => $emp->empId,
                    ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse);
            }
        } catch (Exception $e){
            // set response code
            http_response_code(403);
    
            // show error message
            echo json_encode(array(
                "message" => "Access denied.",
                "error" => $e->getMessage()
            ));
        }
    } else{
     
        // set response code
        http_response_code(401);
     
        // tell the user access denied
        echo json_encode(array("message" => "Access denied."));
    }
?>