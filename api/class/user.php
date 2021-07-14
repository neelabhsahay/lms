<?php
    // 'employee' object
    class Employee{
        // database connection and table name
        private $conn;
        private $table_name = "employees";
     
        // object properties
        public $empId;
        public $firstName;
        public $middleName;
        public $lastName;
        public $email;
        public $contact;
        public $dateOfBirth;
        public $dateOfJoin;
        public $location;
        public $empRole;
        public $empType;
        public $empStatus;
        public $manager;
        public $managerName;
        public $departmentId;
        public $modifiedOn;
        public $key;
    
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }
     
        // create new employee record
        public function create(){

            $getIdQuery = "SELECT empId FROM " . $this->table_name . "
               ORDER BY empId DESC LIMIT 0,1";
            // prepare the getIdQuery
            $stmt = $this->conn->prepare($getIdQuery);
            $stmt->execute();
            // get number of rows
            $num = $stmt->rowCount();

            if($num > 0 ){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                $eId = $result['empId'];
                $num = trim($eId , "EN");
                $num = $num + 1;
                $this->empId = "EN" . sprintf("%04d", $num);
            } else {
                $this->empId = "EN0001";
            }

            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      empId = :empId,
                      firstName = :firstName,
                      middleName = :middleName,
                      lastName = :lastName,
                      email = :email,
                      contact = :contact,
                      dateOfBirth = :dateOfBirth,
                      dateOfJoin = :dateOfJoin,
                      location = :location,
                      empRole = :empRole,
                      empType = :empType,
                      empStatus = :empStatus,
                      manager = :manager,
                      departmentId = :departmentId
                      ";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->firstName=htmlspecialchars(strip_tags($this->firstName));
            $this->middleName=htmlspecialchars(strip_tags($this->middleName));
            $this->lastName=htmlspecialchars(strip_tags($this->lastName));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contact=htmlspecialchars(strip_tags($this->contact));
            $this->dateOfBirth=htmlspecialchars(strip_tags($this->dateOfBirth));
            $this->dateOfJoin=htmlspecialchars(strip_tags($this->dateOfJoin));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->empRole=htmlspecialchars(strip_tags($this->empRole));
            $this->empType=htmlspecialchars(strip_tags($this->empType));
            $this->empStatus=htmlspecialchars(strip_tags($this->empStatus));
            $this->manager=htmlspecialchars(strip_tags($this->manager));
            $this->departmentId=htmlspecialchars(strip_tags($this->departmentId));

            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':middleName', $this->middleName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':contact', $this->contact);
            $stmt->bindParam(':email', $this->email);

            $stmt->bindParam(':dateOfBirth', date( "Y-m-d", strtotime($this->dateOfBirth)));
            $stmt->bindParam(':dateOfJoin', date( "Y-m-d", strtotime($this->dateOfJoin)));
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':empRole', $this->empRole);
            $stmt->bindParam(':empType', $this->empType);
            $stmt->bindParam(':empStatus', $this->empStatus);
            $stmt->bindParam(':manager', $this->manager);
            $stmt->bindParam(':departmentId', $this->departmentId);
            
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // update a employee record
        public function update(){
     
            // if password needs to be updated
            $password_set=!empty($this->password) ? ", password = :password" : "";
     
            // if no posted password, do not update the password
            $query = "UPDATE " . $this->table_name . "
                      SET
                      firstName = :firstName,
                      middleName = :middleName,
                      lastName = :lastName,
                      email = :email,
                      contact = :contact,
                      dateOfBirth = :dateOfBirth,
                      dateOfJoin = :dateOfJoin,
                      location = :location,
                      empRole = :empRole,
                      empType = :empType,
                      empStatus = :empStatus,
                      manager = :manager,
                      departmentId = :departmentId
                      WHERE empId = :empId";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->firstName=htmlspecialchars(strip_tags($this->firstName));
            $this->middleName=htmlspecialchars(strip_tags($this->middleName));
            $this->lastName=htmlspecialchars(strip_tags($this->lastName));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contact=htmlspecialchars(strip_tags($this->contact));
            $this->dateOfBirth=htmlspecialchars(strip_tags($this->dateOfBirth));
            $this->dateOfJoin=htmlspecialchars(strip_tags($this->dateOfJoin));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->empRole=htmlspecialchars(strip_tags($this->empRole));
            $this->empType=htmlspecialchars(strip_tags($this->empType));
            $this->empStatus=htmlspecialchars(strip_tags($this->empStatus));
            $this->manager=htmlspecialchars(strip_tags($this->manager));
            $this->manager=htmlspecialchars(strip_tags($this->manager));
         
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':middleName', $this->middleName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':contact', $this->contact);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':dateOfBirth', date( "Y-m-d", strtotime($this->dateOfBirth)));
            $stmt->bindParam(':dateOfJoin', date( "Y-m-d", strtotime($this->dateOfJoin)));
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':empRole', $this->empRole);
            $stmt->bindParam(':empType', $this->empType);
            $stmt->bindParam(':empStatus', $this->empStatus);
            $stmt->bindParam(':manager', $this->manager);
            $stmt->bindParam(':departmentId', $this->departmentId);         
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }  

        // GET ALL
        public function search(){
            if(!empty($this->key)){
                $this->key=htmlspecialchars(strip_tags($this->key));
                $key = $this->key;
                $query = "SELECT * FROM " . $this->table_name . " WHERE firstName LIKE '{$key}%' OR  
                                                                  middleName LIKE '{$key}%' OR
                                                                  lastName LIKE '{$key}%' 
                                                                  LIMIT 0,5";
            } else {
                $query = "SELECT * FROM " . $this->table_name . " LIMIT 0,5";
            }

            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    
        // GET ALL
        public function getAll(){
            $query = "SELECT m.firstName AS ManagerName, e.* FROM " . $this->table_name . "
             e INNER JOIN " . $this->table_name . " m ON m.empId = e.manager ORDER BY e.empId DESC";
            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY empId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            /*
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
               $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
               print $data;
            }
            */
        }

        public function readDataBackwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY empId DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            /*
            $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            do {
                $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
                print $data;
            } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            */
        }

    
        // Get a employee record
        public function getSingle(){

            $query = "SELECT m.firstName AS managerName, e.* FROM " . $this->table_name . "
             e INNER JOIN " . $this->table_name . " m ON m.empId = e.manager AND e.empId = ? LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->empId = htmlspecialchars(strip_tags($this->empId));
         
            // bind given empId value
            $stmt->bindParam(1, $this->empId);
         
         
            // execute the query
            $stmt->execute();
            // get number of rows
            $num = $stmt->rowCount();

            if($num > 0 ){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                
                $this->empId        = $result['empId'];
                $this->firstName    = $result['firstName'];
                $this->middleName   = $result['middleName'];
                $this->lastName     = $result['lastName'];
                $this->email        = $result['email'];
                $this->contact      = $result['contact'];
                $this->dateOfBirth  = $result['dateOfBirth'];
                $this->dateOfJoin   = $result['dateOfJoin'];
                $this->location     = $result['location'];
                $this->empRole      = $result['empRole'];
                $this->empType      = $result['empType'];
                $this->empStatus    = $result['empStatus'];
                $this->manager      = $result['manager'];
                $this->departmentId = $result['departmentId'];
                $this->modifiedOn   = $result['modifiedOn'];
                $this->managerName  = $result['managerName'];
                return true;
            } 
            return false;
        }


        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->empId=htmlspecialchars(strip_tags($this->empId));
        
            $stmt->bindParam(1, $this->empId);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }


    class User{
        // database connection and table name
        private $conn;
        private $table_name = "login";
     
        // object properties
        public $empId;
        public $username;
        public $email;
        public $password;
        public $passwordType;
        public $accountType;
        public $modifiedOn;
     
        // constructor
        public function __construct($db){
            $this->conn = $db;
        }
        // create new employee record
        function create(){
            // insert query
            $query = "INSERT INTO " . $this->table_name . "
                      SET
                      empId = :empId,
                      username = :username,
                      email = :email,
                      password = :password,
                      passwordType = :passwordType,
                      accountType = :accountType";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
     
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->passwordType=htmlspecialchars(strip_tags($this->passwordType));
            $this->accountType = htmlspecialchars(strip_tags($this->accountType));
     
            // bind the values
            $stmt->bindParam(':empId', $this->empId);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':passwordType', $this->passwordType);
            $stmt->bindParam(':accountType', $this->accountType);
     
            // hash the password before saving to database
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password_hash);
     
            // execute the query, also check if query was successful
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    
        // check if given username exist in the database
        function usernameExists(){
            // query to check if email exists
            $query = "SELECT empId,username, email, password, passwordType, accountType
                     FROM " . $this->table_name . "
                     WHERE username = ?
                     LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare( $query );
     
            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
     
            // bind given username value
            $stmt->bindParam(1, $this->username);
     
            // execute the query
            $stmt->execute();
    
            // get number of rows
            $num = $stmt->rowCount();
     

            // if username exists, assign values to object properties
            // for easy access and use for php sessions
            if($num>0){
                // get record details / values
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
                // assign values to object properties
                $this->empId = $row['empId'];
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->accountType = $row['accountType'];
                $this->passwordType = $row['passwordType'];
                $this->accountType = $row['accountType'];
     
                // return true because email exists in the database
                return true;
            }

            // return false if email does not exist in the database
            return false;
        }
    
        // update a user record
        public function update(){
         
            // if password needs to be updated
            $password_set=!empty($this->password) ? ", password = :password" : "";
            $accountType_set=!empty($this->accountType) ? ", accountType = :accountType" : "";
            $passwordType_set=!empty($this->passwordType) ? ", passwordType = :passwordType" : "";
            $email_set=!empty($this->email) ? ", email = :email" : "";
            // if no posted password, do not update the password
            $query = "UPDATE " . $this->table_name . "
                        SET
                        empId = :empId
                        {$accountType_set}
                        {$accountType_set}
                        {$passwordType_set}
                        {$password_set}
                        WHERE username = :username";
         
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->empId=htmlspecialchars(strip_tags($this->empId));
         
            // bind the values from the form
            $stmt->bindParam(':empId', $this->empId);

            // hash the password before saving to database
            if(!empty($this->password)){
                $this->password=htmlspecialchars(strip_tags($this->password));
                $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $password_hash);
            }

            if(!empty($this->email)){
                $this->email=htmlspecialchars(strip_tags($this->email));
                $stmt->bindParam(':email', $this->email);
            }

            if(!empty($this->passwordType)){
                $this->passwordType=htmlspecialchars(strip_tags($this->passwordType));
                $stmt->bindParam(':passwordType', $this->passwordType);
            }

            if(!empty($this->accountType)){
                $this->accountType=htmlspecialchars(strip_tags($this->accountType));
                $stmt->bindParam(':accountType', $this->accountType);
            }
         
            // unique ID of record to be edited
            $stmt->bindParam(':username', $this->username);
         
            // execute the query
            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
    
         // update a employee record
        public function getAll(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY username DESC";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function readDataForwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY username DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            /*
            while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
               $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
               print $data;
            }
            */
        }

        public function readDataBackwards() {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY username DESC";
            $stmt  = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
            /*
            $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            do {
                $data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
                print $data;
            } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            */
        }

        // Get a employee record
        public function getSingle(){
     
            // if no posted password, do not update the password
            $query = "SELECT * FROM " . $this->table_name . "
                      WHERE username = ?
                      LIMIT 0,1";
     
            // prepare the query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->username = htmlspecialchars(strip_tags($this->username));
         
            // bind given empId value
            $stmt->bindParam(1, $this->username);
         
            $stmt->execute();
         
            // get number of rows
            $num = $stmt->rowCount();
        
            if($num>0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);     
                
                $this->empId          = $result['empId'];
                $this->passwordType   = $result['passwordType'];
                $this->email          = $result['email'];
                $this->accountType    = $result['accountType'];
                $this->passwordType   = $result['passwordType'];
                $this->modifiedOn     = $result['modifiedOn'];
                return true;
            } 
            return false;
        }
    
        // DELETE
        function delete(){
            $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->username=htmlspecialchars(strip_tags($this->username));
        
            $stmt->bindParam(1, $this->username);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>
