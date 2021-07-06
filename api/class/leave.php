<?php
    // 'leave' object

    class Leave{
        // database connection and table name
        private $conn;
        private $table_name = "leaves";
     
        // object properties
        public $leaveId;
        public $leaveType;
        public $leaveMax;
        public $leaveProvMax;
        public $modifiedOn;
     
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }
    
        // create new Leave record
        function create(){
            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      leaveId = :leaveId,
                      leaveType = :leaveType,
                      leaveMax = :leaveMax,
                      leaveProvMax = :leaveProvMax";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->leaveType=htmlspecialchars(strip_tags($this->leaveType));
            $this->leaveMax=htmlspecialchars(strip_tags($this->leaveMax));
            $this->leaveProvMax=htmlspecialchars(strip_tags($this->leaveProvMax));
    
            // bind the values
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':leaveType', $this->leaveType);
            $stmt->bindParam(':leaveMax', $this->leaveMax);
            $stmt->bindParam(':leaveProvMax', $this->leaveProvMax);
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // create new Leave record
        function update(){
            // insert query
            $query = "UPDATE " . $this->table_name . "
                      SET
                      leaveType = :leaveType,
                      leaveMax = :leaveMax,
                      leaveProvMax = :leaveProvMax
                      WHERE leaveId = :leaveId";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->leaveType=htmlspecialchars(strip_tags($this->leaveType));
            $this->leaveMax=htmlspecialchars(strip_tags($this->leaveMax));
            $this->leaveProvMax=htmlspecialchars(strip_tags($this->leaveProvMax));
    
            // bind the values
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':leaveType', $this->leaveType);
            $stmt->bindParam(':leaveMax', $this->leaveMax);
            $stmt->bindParam(':leaveProvMax', $this->leaveProvMax);
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // Read all Leaves record
        public function getAll(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //   $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //}
        }

        public function readDataBackwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            //do {
            //    $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //    print $data;
            //} while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
        }
    
        // Get a employee record
        public function getSingle(){
        
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE leaveId = ?
                      LIMIT 0,1";
        
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->leaveId = htmlspecialchars(strip_tags($this->leaveId));
         
            // bind given empId value
            $stmt->bindParam(1, $this->leaveId);
         
         
            // execute the query
            if($stmt->execute()){
                // get number of rows
                $num = $stmt->rowCount();
         
                if($num>0){
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                    
                    $this->leaveId       = $result['leaveId'];
                    $this->leaveType     = $result['leaveType'];
                    $this->leaveMax      = $result['leaveMax'];
                    $this->leaveProvMax  = $result['leaveProvMax'];
                    $this->modifiedOn    = $result['modifiedOn']; 
                    return true;
                } 
                return false;
            }
            return false;
        }


        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE leaveId = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
        
            $stmt->bindParam(1, $this->leaveId);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
   
    class LeaveStatus{
       // database connection and table name
       private $conn;
       private $table_name = "emp_leaves_status";
    
       // object properties
       public $leaveId;
       public $empId;
       public $year;
       public $leaveCarried;
       public $leaveInYear;
       public $leaveUsed;
       public $modifiedBy;
       public $modifiedOn;
    
      
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }
    
        // create new LeaveStatus record
        function create(){
            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      empId = :empId,
                      leaveId = :leaveId,
                      year = :year,
                      leaveCarried = :leaveCarried,
                      leaveInYear = :leaveInYear,
                      leaveUsed = :leaveUsed,
                      modifiedBy = :modifiedBy";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->year=htmlspecialchars(strip_tags($this->year));
            $this->leaveCarried=htmlspecialchars(strip_tags($this->leaveCarried));
            $this->leaveInYear=htmlspecialchars(strip_tags($this->leaveInYear));
            $this->leaveUsed=htmlspecialchars(strip_tags($this->leaveUsed));
            $this->modifiedBy=htmlspecialchars(strip_tags($this->modifiedBy));
     
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':year', $this->year);
            $stmt->bindParam(':leaveCarried', $this->leaveCarried);
            $stmt->bindParam(':leaveInYear', $this->leaveInYear);
            $stmt->bindParam(':leaveUsed', $this->leaveUsed);
            $stmt->bindParam(':modifiedBy', $this->modifiedBy);
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // create new LeaveStatus record
        function update(){
            // insert query
            $query = "UPDATE " . $this->table_name . "
                      SET
                      empId = :empId,
                      leaveId = :leaveId,
                      year = :year,
                      leaveCarried = :leaveCarried,
                      leaveInYear = :leaveInYear,
                      leaveUsed = :leaveUsed,
                      modifiedBy = :modifiedBy
                      WHERE leaveId = :leaveId AND 
                      empId = :empId AND year = :year";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->year=htmlspecialchars(strip_tags($this->year));
            $this->leaveCarried=htmlspecialchars(strip_tags($this->leaveCarried));
            $this->leaveInYear=htmlspecialchars(strip_tags($this->leaveInYear));
            $this->leaveUsed=htmlspecialchars(strip_tags($this->leaveUsed));
            $this->modifiedBy=htmlspecialchars(strip_tags($this->modifiedBy));
     
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':year', $this->year);
            $stmt->bindParam(':leaveCarried', $this->leaveCarried);
            $stmt->bindParam(':leaveInYear', $this->leaveInYear);
            $stmt->bindParam(':leaveUsed', $this->leaveUsed);
            $stmt->bindParam(':modifiedBy', $this->modifiedBy);
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // Read all Leaves status record
        public function getAll(){
     
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //   $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //}
            
        }

        public function readDataBackwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY leaveId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            //do {
            //    $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //    print $data;
            //} while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
        }

        // Get a employee record
        public function getSingle(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE empId = ? AND leaveId = ? AND year = ?
                      LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->empId = htmlspecialchars(strip_tags($this->empId));
         
            // bind given empId value
            $stmt->bindParam(1, $this->empId);
            $stmt->bindParam(2, $this->leaveId);
            $stmt->bindParam(3, $this->year);
         
         
            // execute the query
            if($stmt->execute()){
                // get number of rows
                $num = $stmt->rowCount();
         
                if($num>0){
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                    
                    $this->empId        = $result['empId'];
                    $this->leaveId      = $result['leaveId'];
                    $this->year         = $result['year'];
                    $this->leaveCarried = $result['leaveCarried'];
                    $this->leaveInYear  = $result['leaveInYear'];
                    $this->leaveUsed    = $result['leaveUsed'];
                    $this->modifiedBy   = $result['modifiedBy'];
                    $this->modifiedOn   = $result['modifiedOn'];
    
                    return true;
                } 
                return false;
            }
            return false;
        }


        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE empId = ? 
            AND leaveId = ? AND year = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->empId=htmlspecialchars(strip_tags($this->empId));
        
            $stmt->bindParam(1, $this->empId);
            $stmt->bindParam(2, $this->leaveId);
            $stmt->bindParam(3, $this->year);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

    
    class LeaveRequest{
       // database connection and table name
       private $conn;
       private $table_name = "emp_leaves_request";
    
       // object properties
       public $reqId;
       public $leaveId;
       public $empId;
       public $appliedBy;
       public $appliedDate;
       public $leaveDays;
       public $startDate;
       public $endDate;
       public $reason;
       public $status;
       public $approver;
       public $modifiedOn;
    
      
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }
    
        // create new LeaveStatus record
        public function create(){
            $status_set=!empty($this->status) ? ", status = :status" : "";
            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      empId = :empId,
                      leaveId = :leaveId,
                      appliedBy = :appliedBy,
                      appliedDate = :appliedDate,
                      leaveDays = :leaveDays,
                      startDate = :startDate,
                      endDate = :endDate,
                      reason = :reason,
                      approver = :approver
                      {$status_set}";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->appliedBy=htmlspecialchars(strip_tags($this->appliedBy));
            $this->appliedDate=htmlspecialchars(strip_tags($this->appliedDate));
            $this->leaveDays=htmlspecialchars(strip_tags($this->leaveDays));
            $this->startDate=htmlspecialchars(strip_tags($this->startDate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->reason=htmlspecialchars(strip_tags($this->reason));
            $this->approver=htmlspecialchars(strip_tags($this->approver));
           
     
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':appliedBy', $this->appliedBy);
            $stmt->bindParam(':leaveDays', $this->leaveDays);
            $stmt->bindParam(':appliedDate', date( "Y-m-d", strtotime($this->appliedDate)));
            $stmt->bindParam(':startDate', date( "Y-m-d", strtotime($this->startDate)));
            $stmt->bindParam(':endDate', date( "Y-m-d", strtotime($this->endDate)));
            $stmt->bindParam(':reason', $this->reason);
            $stmt->bindParam(':approver', $this->approver);
            

            if(!empty($this->status)){
                $this->status=htmlspecialchars(strip_tags($this->status));
                $stmt->bindParam(':status', $this->status);
            }
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // create new LeaveStatus record
        public function update(){

            $leaveDays_set=!empty($this->leaveDays) ? ", leaveDays = :leaveDays " : "";
            $startDate_set=!empty($this->leaveDays) ? ", startDate = :startDate " : "";
            $endDate_set=!empty($this->endDate) ?   ", endDate = :endDate " : "";
            $status_set=!empty($this->status) ? ", status = :status " : "";
            $reason_set=!empty($this->reason) ? ", reason = :reason " : "";
            $approver_set=!empty($this->approver) ? ", approver = :approver " : "";

            // insert query
            $query = "UPDATE " . $this->table_name . "
                      SET
                      empId = :empId,
                      leaveId = :leaveId,
                      appliedBy = :appliedBy,
                      appliedDate = :appliedDate
                      {$approver_set}
                      {$leaveDays_set}
                      {$startDate_set}
                      {$endDate_set}
                      {$status_set}
                      {$reason_set}
                      WHERE reqId = :reqId";
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->appliedBy=htmlspecialchars(strip_tags($this->appliedBy));
            $this->appliedDate=htmlspecialchars(strip_tags($this->appliedDate));
            $this->reqId=htmlspecialchars(strip_tags($this->reqId));
     
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':appliedBy', $this->appliedBy);
            $stmt->bindParam(':appliedDate', date( "Y-m-d", strtotime($this->appliedDate)));     
            $stmt->bindParam(':reqId', $this->reqId);

            if(!empty($this->status)){
                $this->status=htmlspecialchars(strip_tags($this->status));
                $stmt->bindParam(':status', $this->status);
            }

            if(!empty($this->leaveDays)){
                $this->leaveDays=htmlspecialchars(strip_tags($this->leaveDays));
                $stmt->bindParam(':leaveDays', $this->leaveDays);
            }

            if(!empty($this->startDate)){
                $this->startDate=htmlspecialchars(strip_tags($this->startDate));
                $stmt->bindParam(':startDate', date( "Y-m-d", strtotime($this->startDate)));
            }
            if(!empty($this->endDate)){
                $this->endDate=htmlspecialchars(strip_tags($this->endDate));
                $stmt->bindParam(':endDate', date( "Y-m-d", strtotime($this->endDate)));
            }
            if(!empty($this->reason)){
                $stmt->bindParam(':reason', $this->reason);
                $this->reason=htmlspecialchars(strip_tags($this->reason));
            }
            if(!empty($this->approver)){
                $stmt->bindParam(':approver', $this->approver);
                $this->approver=htmlspecialchars(strip_tags($this->approver));
            }
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // Read all Leaves status record
        public function getAll(){
     
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY reqId DESC";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY reqId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //   $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //}
            
        }

        public function readDataBackwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY reqId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            
            //$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            //do {
            //    $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //} while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
        }

        // Get a employee record
        public function getSingle(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE reqId = ?
                      LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->empId = htmlspecialchars(strip_tags($this->empId));
         
            // bind given empId value
            $stmt->bindParam(1, $this->reqId);         
         
            // execute the query
            if($stmt->execute()){
                // get number of rows
                $num = $stmt->rowCount();
         
                if($num>0){
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                    
                    $this->empId        = $result['empId'];
                    $this->leaveId      = $result['leaveId'];
                    $this->appliedBy    = $result['appliedBy'];
                    $this->appliedDate  = $result['appliedDate'];
                    $this->leaveDays    = $result['leaveDays'];
                    $this->startDate    = $result['startDate'];
                    $this->endDate      = $result['endDate'];
                    $this->approver     = $result['approver'];
                    $this->reason       = $result['reason'];
                    $this->reqId        = $result['reqId'];
                    $this->status       = $result['status'];
                    $this->modifiedOn   = $result['modifiedOn'];
    
                    return true;
                } 
                return false;
            }
            return false;
        }
    }
  
?>
