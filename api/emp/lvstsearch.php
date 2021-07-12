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
    $lvStatus = new LeaveStatus($db);

 
    // get jwt
    $jwt=isset($data->jwt) ? $data->jwt : "";
 
    // if jwt is not empty
    if($jwt){
        // if decode succeed, show user details
        try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $lvStatus->key = $data->key;
            $stmt = $lvStatus->search();
            $itemCount = $stmt->rowCount();

            if($itemCount > 0){
                
                $lvStatusArr = array();
                $lvStatusArr["body"] = array();
                $lvStatusArr["itemCount"] = $itemCount;
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $e = array(
                        "leaveId"      => $row['leaveId'],
                        "empId"        => $row['empId'],
                        "year"         => $row['year'],
                        "leaveCarried" => $row['leaveCarried'],
                        "leaveInYear"  => $row['leaveInYear'],
                        "leaveUsed"    => $row['leaveUsed'],
                        "modifiedBy"   => $row['modifiedBy'],
                        "modifiedOn"   => $row['modifiedOn'],
                        "employeeName" => $row['employeeName'],
                        "leaveType"    => $row['leaveType']
                    );
        
                    array_push($lvStatusArr["body"], $e);
                }
                echo json_encode($lvStatusArr);
            } else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
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