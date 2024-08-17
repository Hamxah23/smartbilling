<?php
class Department{
    private $conn;
    public $stmt;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_department($department){
        try{
            $sql = "INSERT INTO `department_tbl` (`Department`) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':department', $department);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Record department failed to inser'. $e->getMessage());
        }
    }

    public function getDpt($sql){
        $this->conn;
        $stmt = $this->conn->query($sql);
        return $stmt;
    }
}