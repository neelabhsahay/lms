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
            $getIdQuery = "SELECT leaveId FROM " . $this->table_name . "
               ORDER BY leaveId DESC LIMIT 0,1";
            // prepare the getIdQuery
            $stmt = $this->conn->prepare($getIdQuery);
            $stmt->execute();
            // get number of rows
            $num = $stmt->rowCount();

            if($num > 0 ){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                $eId = $result['leaveId'];
                $num = trim($eId , "LV");
                $num = $num + 1;
                $this->leaveId = "LV" . sprintf("%04d", $num);
            } else {
                $this->leaveId = "LV0001";
            }

            $leaveProvMax_set=!empty($this->leaveProvMax) ? ", leaveProvMax = :leaveProvMax" : "";
            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      leaveId = :leaveId,
                      leaveType = :leaveType,
                      leaveMax = :leaveMax
                      {$leaveProvMax_set}";

            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->leaveType=htmlspecialchars(strip_tags($this->leaveType));
            $this->leaveMax=htmlspecialchars(strip_tags($this->leaveMax));
    
            // bind the values
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':leaveType', $this->leaveType);
            $stmt->bindParam(':leaveMax', $this->leaveMax);
            

            if( !empty($this->leaveProvMax) ) {
                $this->leaveProvMax=htmlspecialchars(strip_tags($this->leaveProvMax));
                $stmt->bindParam(':leaveProvMax', $this->leaveProvMax);
            }
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // create new Leave record
        function update(){
            $leaveProvMax_set=!empty($this->leaveProvMax) ? ", leaveProvMax = :leaveProvMax " : "";
            $leaveMax_set=!empty($this->leaveMax) ? ", leaveMax = :leaveMax " : "";
            // insert query
            $query = "UPDATE " . $this->table_name . "
                      SET
                      leaveType = :leaveType
                      {$leaveMax_set}
                      {$leaveProvMax_set}
                      WHERE leaveId = :leaveId";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
            $this->leaveType=htmlspecialchars(strip_tags($this->leaveType));
    
            // bind the values
            $stmt->bindParam(':leaveId', $this->leaveId);
            $stmt->bindParam(':leaveType', $this->leaveType);


            if( !empty($this->leaveMax) ) {
                $this->leaveMax=htmlspecialchars(strip_tags($this->leaveMax));
                $stmt->bindParam(':leaveMax', $this->leaveMax);
            }

            if( !empty($this->leaveProvMax) ) {
                $this->leaveProvMax=htmlspecialchars(strip_tags($this->leaveProvMax));
                $stmt->bindParam(':leaveProvMax', $this->leaveProvMax);
            }
     
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
       public $employeeName;
       public $leaveType;
       public $key;
    
      
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

        private function getReadQuery() {
            $con_no = 0;
            $clause = "";
            $con_array = array();
            if(!empty($this->empId)){
                array_push($con_array, " lvst.empId = :empId " );
            }

            if(!empty($this->leaveId)){
               array_push($con_array, " lvst.leaveId = :leaveId " );    
            }
            if(!empty($this->year)){
                array_push($con_array, " lvst.year = :year " );
            }

            if( count($con_array) > 0 ) {
                $clause = "AND  ( ";
                foreach ($con_array as $cons) {
                    $con_no++;
                    $clause = $clause . $cons ;
                    if( $con_no !== count($con_array) ) {
                        $clause = $clause . " AND " ;
                    }
                }
                $clause = $clause . " ) " ;
            }
            
            $query = "SELECT
                         e.firstName as employeeName,
                         l.leaveType as leaveType,
                         lvst.* FROM employees as e JOIN " . $this->table_name . " 
                         as lvst ON
                         e.empId = lvst.empId JOIN
                         leaves as l  ON
                         l.leaveId = lvst.leaveId {$clause} ORDER BY leaveId DESC";
            return $query;

        }
    
        // Read all Leaves status record
        public function getAll(){        
            
            $query = $this->getReadQuery();
   
            // prepare the query
            $stmt = $this->conn->prepare($query);

            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->year)){
                $this->year=htmlspecialchars(strip_tags($this->year));
                $stmt->bindParam(':year', $this->year);
            }
           
            $stmt->execute();
            return $stmt;
        }

        // GET ALL
        public function search(){
            if(!empty($this->key)){
                $this->key=htmlspecialchars(strip_tags($this->key));
                $key = $this->key;
                $query = "SELECT
                         e.firstName as employeeName,
                         l.leaveType as leaveType,
                         lvst.* FROM employees as e JOIN "   . $this->table_name . " 
                         as lvst ON
                         e.empId = lvst.empId JOIN
                         leaves as l  ON
                         l.leaveId = lvst.leaveId 
                         AND ( e.firstName LIKE '{$key}%' OR
                         e.middleName LIKE '{$key}%' OR e.lastName LIKE '{$key}%' ) LIMIT 0,5";
            } else {
                $query = $this->getReadQuery();
            }

            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = $this->getReadQuery();
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->year)){
                $this->year=htmlspecialchars(strip_tags($this->year));
                $stmt->bindParam(':year', $this->year);
            }
            $stmt->execute();
            return $stmt;
            
            //while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //   $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //}
            
        }

        public function readDataBackwards() {
            $query = $this->getReadQuery();
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->year)){
                $this->year=htmlspecialchars(strip_tags($this->year));
                $stmt->bindParam(':year', $this->year);
            }
            $stmt->execute();
            return $stmt;
            
            //$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            //do {
            //    $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //    print $data;
            //} while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
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
    
        // create new LeaveRequest record
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

        // create new LeaveRequest record
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

        private function getReadQuery() {
            $con_no = 0;
            $clause = "";
            $con_array = array();
            if(!empty($this->empId)){
                array_push($con_array, " empId = :empId " );
            }

            if(!empty($this->approver)){
               array_push($con_array, " approver = :approver " );    
            }
            if(!empty($this->leaveId)){
                array_push($con_array, " leaveId = :leaveId " );
            }

            if( count($con_array) > 0 ) {
                $clause = "WHERE ";
                foreach ($con_array as $cons) {
                    $con_no++;
                    $clause = $clause . $cons ;
                    if( $con_no !== count($con_array) ) {
                        $clause = $clause . " AND " ;
                    }
                }
            }
    
            $query = "SELECT * FROM " . $this->table_name . " {$clause} ORDER BY startDate DESC";
            return $query;

        }
    
        // Read all Leaves status record
        public function getAll(){
     
            $query = $this->getReadQuery();
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->approver)){
                $this->approver=htmlspecialchars(strip_tags($this->aprover));
                $stmt->bindParam(':approver', $this->approver);
            }
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = $this->getReadQuery();
     
            // prepare the query
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            
            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->approver)){
                $this->approver=htmlspecialchars(strip_tags($this->approver));
                $stmt->bindParam(':approver', $this->approver);
            }
            $stmt->execute();
            return $stmt;
            
            //while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            //   $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //}
            
        }

        public function readDataBackwards() {
            $query = $this->getReadQuery();
     
            // prepare the query
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            
            if(!empty($this->empId)){
                $this->empId=htmlspecialchars(strip_tags($this->empId));
                $stmt->bindParam(':empId', $this->empId);
            }
            if(!empty($this->leaveId)){
                $this->leaveId=htmlspecialchars(strip_tags($this->leaveId));
                $stmt->bindParam(':leaveId', $this->leaveId);
            }
            if(!empty($this->approver)){
                $this->approver=htmlspecialchars(strip_tags($this->approver));
                $stmt->bindParam(':approver', $this->approver);
            }
            $stmt->execute();
            return $stmt;
            
            //$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            //do {
            //    $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
            //   print $data;
            //} while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
        }

        // Get a leave request record
        public function getSingle(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE reqId = ?
                      LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->reqId = htmlspecialchars(strip_tags($this->reqId));
         
            // bind given reqId value
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
