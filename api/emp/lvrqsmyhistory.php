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
            
            $lvRequest->reqId = $data->reqId;
            $lvRequest->empId = $decoded->data->empId;
            $lvRequest->leaveId = $data->leaveId;
            $lvRequest->getCount = $data->getCount;
            if( !empty($lvRequest->reqId)) {     
                if( $lvRequest->getSingle() ) {
                    
                    $employeeArr = array();
                    $employeeArr["body"] = array();
                    $employeeArr["itemCount"] = 1;
                    $employeeArr["totalCount"] = 1;
            
                    $e = array(
                        "reqId"       => $lvRequest->reqId,
                        "leaveId"     => $lvRequest->leaveId,
                        "leaveType"   => $lvRequest->leaveType,
                        "empId"       => $lvRequest->empId,
                        "appliedBy"   => $lvRequest->appliedBy,
                        "appliedDate" => $lvRequest->appliedDate,
                        "leaveDays"   => $lvRequest->leaveDays,
                        "startDate"   => $lvRequest->startDate,
                        "endDate"     => $lvRequest->endDate,
                        "reason"      => $lvRequest->reason,
                        "status"      => $lvRequest->status,
                        "approver"    => $lvRequest->approver,
                        "leaveRqtState"=> $lvRequest->leaveRqtState,
                        "modifiedOn"  => $lvRequest->modifiedOn
                    );
            
                    array_push($employeeArr["body"], $e);
                    echo json_encode($employeeArr);
                } else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "No record found.")
                    );
                }
            } else {
                $stmt = $lvRequest->getAll();
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0){
                    
                    $employeeArr = array();
                    $employeeArr["body"] = array();
                    $employeeArr["itemCount"] = $itemCount;
                    $employeeArr["totalCount"] = $lvRequest->totalCount;
            
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $e = array(
                            "reqId"       => $row['reqId'],
                            "leaveId"     => $row['leaveId'],
                            "leaveType"   => $row['leaveType'],
                            "empId"       => $row['empId'],
                            "appliedBy"   => $row['appliedBy'],
                            "appliedDate" => $row['appliedDate'],
                            "leaveDays"   => $row['leaveDays'],
                            "startDate"   => $row['startDate'],
                            "endDate"     => $row['endDate'],
                            "reason"      => $row['reason'],
                            "status"      => $row['status'],
                            "approver"    => $row['approver'],
                            "leaveRqtState"=> $row['leaveRqtState'],
                            "modifiedOn"  => $row['modifiedOn']
                        );
            
                        array_push($employeeArr["body"], $e);
                    }
                    echo json_encode($employeeArr);
                } else{
                    http_response_code(200);
                    $employeeArr = array();
                    $employeeArr["body"] = array();
                    $employeeArr["itemCount"] = 0;
                    $employeeArr["totalCount"] = 0;
                    echo json_encode($employeeArr);
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