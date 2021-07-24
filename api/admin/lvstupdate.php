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
    include_once '../class/leave.php';

    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // instantiate product object
    $lvStatus = new LeaveStatus($db);
     
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
     
    // if jwt is not empty
    if($jwt){
        try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            
            // set product property values
            $lvStatus->leaveId      = $data->leaveId;
            $lvStatus->empId        = $data->empId;
            $lvStatus->year         = $data->year;
            $lvStatus->leaveCarried = $data->leaveCarried;
            $lvStatus->leaveInYear  = $data->leaveInYear;
            $lvStatus->leaveUsed    = $data->leaveUsed;
            $lvStatus->modifiedBy   = $decoded->data->empId;
            
            // create the user
            if( !empty($lvStatus->leaveId) &&
                !empty($lvStatus->empId) &&
                !empty($lvStatus->year) &&
                !empty($lvStatus->modifiedBy) &&
                $lvStatus->update()
            ){
                // set response code
                http_response_code(200);
             
                // display message: user was created
                $insertResponse = array();
                $insertResponse["message"] = "Leave Status record was updated.";
                $insertResponse["status"] = "passed";
                $insertResponse["data"] = array();
                $e = array(
                    "leaveId" => $lvStatus->leaveId,
                    "empId"   => $lvStatus->empId,
                    "year"    => $lvStatus->year,
                    "modifiedBy" => $lvStatus->modifiedBy
                ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse); 
            } else{
             
                // set response code
                http_response_code(400);
             
                // display message: unable to create user
                $insertResponse = array();
                $insertResponse["message"] = "Unable to update leave status record.";
                $insertResponse["status"] = "failed";
                $insertResponse["data"] = array();
                $e = array(
                    "leaveId" => $lvStatus->leaveId,
                    "empId"   => $lvStatus->empId,
                    "year"    => $lvStatus->year
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
