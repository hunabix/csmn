<?php

class connection {

	private $host		= DB_SERVER;
	private $dbname		= DB_NAME;
	private $username	= DB_USER;
	private $password	= DB_PASS;  
	
	public $con 		= '';
	
    //Called automatically upon initiation
    function __construct() {

        try {
            
			$this->con = new PDO("mysql:host=$this->host;charset=utf8;dbname=$this->dbname",$this->username, $this->password); //Initiates connection
            
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sets error mode
        
		} catch (PDOException $e) {
            
			file_put_contents("log/dberror.log", "Date: " . date('M j Y - G:i:s') . " ---- Error: " . $e->getMessage().PHP_EOL, FILE_APPEND);
			
            die($e->getMessage()); // Log and display error in the event that there is an issue connecting
			
        }
		
    }
	
	//Returns instance of PDO and enables PDO methods
	public function getDb() {
		
		if ($this->con instanceof PDO) {
			
			return $this->con;
			
		}
		
	}

    //Called automatically when there are no further references to object
    function __destruct() {

        try {

            $this->con = null; //Closes connection

        } catch (PDOException $e) {

            file_put_contents("log/dberror.log", "Date: " . date('M j Y - G:i:s') . " ---- Error: " . $e->getMessage().PHP_EOL, FILE_APPEND);

            die($e->getMessage());

        }

    }

}