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
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // instantiate product object
    $lvRequest = new LeaveRequest($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
     
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";

    // if jwt is not empty
    if($jwt){
         try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            // set product property values
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
            $lvRequest->year        = $data->startDate.getFullYear();
            
            // create the leave request
            if( !empty($lvRequest->leaveId) &&
                !empty($lvRequest->empId) &&
                !empty($lvRequest->appliedBy) &&
                !empty($lvRequest->appliedDate) &&
                !empty($lvRequest->leaveDays) &&
                !empty($lvRequest->startDate) &&
                !empty($lvRequest->endDate) &&
                !empty($lvRequest->approver) &&
                $lvRequest->create()
            ){
                // set response code
                http_response_code(200);
             
                $insertResponse = array();
                $insertResponse["message"] =  "Inserted leave request.";
                $insertResponse["status"] = "passed";
                $insertResponse["data"] = array();
                $e = array(
                    "reqId"      => $lvRequest->reqId,
                ); 
                array_push($insertResponse["data"], $e);
                echo json_encode($insertResponse);
            } else{
             
                // set response code
                http_response_code(400);
             
                // display message: unable to create user
                $insertResponse = array();
                $insertResponse["message"] =  "Unable to insert leave request record.";
                $insertResponse["status"] = "failed";
                $insertResponse["data"] = array();
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
