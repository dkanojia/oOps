<?php 

define('SERVER_HOST', 'localhost');
define('SERVER_USER_NAME', 'root');
define('SERVER_PASSWORD', '');
define('SERVER_DB_NAME', 'oops');


class DBConnection
{
    public $hostname, $username, $password, $db_name, $conn;

    public function __construct($hostname = null,$username = null,$password = null,$db_name = null){
        
        if($hostname)
	        $this->hostname = $hostname;
	    else
	        $this->hostname = SERVER_HOST;

	    if($username)
	        $this->username = $username;
	    else
	        $this->username = SERVER_USER_NAME;
        
        if($password)
	        $this->password = $password;
	    else
	        $this->password = SERVER_PASSWORD;

	    if($db_name)
	        $this->db_name = $db_name;
	    else
	        $this->db_name = SERVER_DB_NAME;
    }

    public function connectToMySQL_I(){
	    $this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->db_name);

        if($this->conn->connect_error){
            die( "Could not connect to MySQL");
        }
        
        return $this->conn;
    }
}

?>