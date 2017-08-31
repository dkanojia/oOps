<?php
include('db_config.php');

class chkTables{
	
	private $table, $conn;
	public $sql, $fields,$is_table_exist;

	public function __construct(){
		$myObj = new DBConnection();
	    $this->conn = $myObj->connectToMySQL_I();
	}

	private function checkTable($table_name){
		$this->table = $table_name; 
		
		if ($result = $this->conn->query("SHOW TABLES LIKE '".$this->table."'")) {
		    if($result->num_rows == 1) {
				return true;
		    }
		}
		else {
		    return false;
		}
	}

	private function createTable($table_name,$fields){
		$this->table = $table_name; 
		$result = $this->conn->query('CREATE TABLE `oops`.`'.$this->table.'` ( 
										`id` INT NOT NULL AUTO_INCREMENT , '.$fields.', 
										PRIMARY KEY (`id`)) 
										ENGINE = InnoDB');

		if($result === TRUE){
			$this->insertFirstUser($table_name);
			echo "Successfully ".$table_name." created";
		}
		else
			echo "Successfully ".$table_name." not created";
	}

	public function getUser($user_table){
		$this->is_table_exist = $this->checkTable($user_table);

		if($this->is_table_exist != null){
			return $this->getUserInfo($user_table);
		}else{
			$this->fields = '`name` VARCHAR(255) NOT NULL';
			return $this->createTable($user_table,$this->fields);
		}
	}

	private function getUserInfo($table_name){
		$this->table = $table_name;
		$result = $this->conn->query('SELECT id, name FROM '.$this->table.'');

		if ($result->num_rows >= 1) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
		    }
		} else {
		    echo "0 results";
		}
	}

	private function insertFirstUser($table_name){
		$this->table = $table_name;
		$result = $this->conn->query("INSERT INTO ".$this->table." (name) VALUES ('FirstAdminUser')");
		if($result === TRUE){
			return $this->getUserInfo($table_name);
		}
		else{
			echo "User Info properly not inserted";
			exit;
		}
	}
}