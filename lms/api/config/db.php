<?php
    class Database{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = '';
        private $dbname = 'mylms';
        public $dbConn;

        // Connect
        public function getConnection(){
            $this->dbConn = null;
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            try {
                $this->dbConn = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
                $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->dbConn;
        }
    }
?>
