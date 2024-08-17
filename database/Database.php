<?php
class Database{
	private $dbhost = 'localhost';
	private $dbname = 'billing_db';
	private $dbuser = 'root';
	private $dbpass = '';
	private $conn;
	public $stmt;

	public function setConnection(){
		 $this->conn = null;
		 try{
				$this->conn = new PDO('mysql:host='. $this->dbhost. ';dbname='. $this->dbname, $this->dbuser, $this->dbpass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo 'Database Connected'.'<br/>';
		 }catch(PDOException $e){
				die('Failed to Connect Database'. $e->getMessage());
		 }
	}
	
	public function getConnection(){
		 $this->setConnection();
		 return $this->conn;
	}
	
	public function query($query){
		 $this->stmt = $this->conn->prepare($query);
		 $this->stmt->execute();
		 return $this;
	}

	public function fetchAll(){
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
} 

/* 
$dbhost = 'localhost';
$dbname = 'billing_db';
$dbuser = 'root';
$dbpass = '';

try{
    $conn = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "success";
}catch(PDOException $e){
    echo 'Faild to Connect to the DB'. $e->getMessage();
} */