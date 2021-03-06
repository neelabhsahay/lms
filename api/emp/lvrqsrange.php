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

            $lvRequest->empId = $decoded->data->empId;
            $lvRequest->rangeStart = $data->rangeStart;
            $lvRequest->rangeEnd = $data->rangeEnd;

            if(empty($lvRequest->rangeStart) &&
                empty($lvRequest->rangeEnd) ) {
                http_response_code(400);

                $insertResponse = array();
                $insertResponse["message"] =  "Incomplete data passed to API.";
                $insertResponse["status"] = "failed";
                $insertResponse["data"] = array();
                echo json_encode($insertResponse);
            } else {

                $stmt = $lvRequest->getInRange();
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0){
                    $employeeArr = array();
                    $employeeArr["body"] = array();
                    $employeeArr["itemCount"] = $itemCount;
                    $employeeArr["totalCount"] = $itemCount;
            
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $e = array(
                            "reqId"       => $row['reqId'],
                            "leaveId"     => $row['leaveId'],
                            "empId"       => $row['empId'],
                            "appliedBy"   => $row['appliedBy'],
                            "appliedDate" => $row['appliedDate'],
                            "leaveDays"   => $row['leaveDays'],
                            "startDate"   => $row['startDate'],
                            "endDate"     => $row['endDate'],
                            "reason"      => $row['reason'],
                            "status"      => $row['status'],
                            "approver"    => $row['approver'],
                            "modifiedOn"  => $row['modifiedOn'],
                            "leaveType"   => $row['leaveType']
                        );
            
                        array_push($employeeArr["body"], $e);
                    }
                    echo json_encode($employeeArr);
                } else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "No record found.")
                    );
                }
            }
        }catch (Exception $e){
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