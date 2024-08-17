<?php
require_once __DIR__ . '/../database/Database.php';

$db = new Database();
$dbconn = $db->getConnection();
$errors = [];
$success = [];

if($_SERVER['REQUEST'] == 'POST'){
  $unit = htmlspecialchars($_POST['units']);
  $unitId = htmlentities($_POST['unitId']);

  if(empty(trim($unit))){
    $errors['unit'] = 'Unit field cannot be empty!';
  }else{
    $stmt = $dbconn->prepare("UPDATE `department_tbl` SET `Department` = ':unit' WHERE `deptID ` = ':unitId' ");
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':unitId', $unitId);
    $result = $stmt->execute();
  
    if($result){
      $success['success'] = 'Unit Updated successfully!';
    }else{
      $errors['dbError'] = 'Database Failure!';
    }

  }
}