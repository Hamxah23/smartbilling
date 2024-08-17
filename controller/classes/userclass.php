<?php
class AddUser{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addRecord($fname, $email, $phone, $department){
        try{
            $sql = "INSERT INTO `users_tbl` (`fullname`, `Email`, `Phone`, `Department`) VALUES (:fullname, :email, :phone, :department)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fullname', $fname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':department', $department);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Record failed to insert'. $e->getMessage());
        }
    }

    public function getUsers($sql){
        $this->conn;
        $stmt = $this->conn->query($sql);
        return $stmt;
    }
}