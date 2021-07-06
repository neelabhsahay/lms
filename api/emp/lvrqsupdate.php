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
     
    // instantiate user object
    $lvRequest = new LeaveRequest($db);
     
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
     
    // if jwt is not empty
    if($jwt){
        // if decode succeed, show user details
        try {   
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            // set product property values
            $lvRequest->reqId       = $data->reqId;
            $lvRequest->leaveId     = $data->leaveId;
            $lvRequest->empId       = $data->empId;
            $lvRequest->appliedBy   = $data->appliedBy;
            $lvRequest->appliedDate = $data->appliedDate;
            $lvRequest->leaveDays   = $data->leaveDays;
            $lvRequest->startDate   = $data->startDate;
            $lvRequest->endDate     = $data->endDate;
            $lvRequest->reason      = $data->reason;
            $lvRequest->status      = $data->status;
            $lvRequest->approver    = $data->approver;

            // create the leave request
            if( !empty($lvRequest->reqId) &&
                !empty($lvRequest->approver) &&
                $lvRequest->update()
            ) {
                // set response code
                http_response_code(200);
             
                // display message: user was created
                echo json_encode(array("message" => "Leave Request record was updated."));

            } else {
                // set response code
                http_response_code(401);
             
                // show error message
                echo json_encode(array("message" => "Unable to update Leave Request."));
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
    } else{
     
        // set response code
        http_response_code(401);
     
        // tell the user access denied
        echo json_encode(array("message" => "Access denied."));
    }
?>