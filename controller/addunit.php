<?php
require_once __DIR__ . '/../database/Database.php';

$db = new Database();
$dbconn = $db->getConnection();
$errors = [];
$success = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $unit = htmlspecialchars($_POST['units']);

  $stmt = $dbconn->prepare("SELECT `Department` FROM `department_tbl` WHERE `Department` = :unit");
  $stmt->bindParam(':unit', $unit);
  $stmt->execute();
  $unitExist = $stmt->rowCount();

  if(empty(trim($unit))){
    $errors['emptyUnit'] = 'Unit is required!';
  }elseif($unitExist > 0){
    $errors['unitExists'] = 'Unit already exists!';
  }else{
    $stmt = $dbconn->prepare("INSERT INTO `department_tbl` (`Department`) VALUES (:unit) ");
    $stmt->bindParam(':unit', $unit);
    $result = $stmt->execute();
    if($result){
      $success['success'] = 'Unit added successfully!';
    }
  }

  
  if(count($errors) > 0){
    echo json_encode([
      "status" => false,
      "errors" => $errors
    ]);
  }else{
    echo json_encode([
      "status" => true,
      "message" => $success
    ]);
  }
  
}

 /*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $unit = htmlspecialchars($_POST['units']);

  if (empty(trim($unit))) {
      $errors['emptyUnit'] = 'Unit is Required!';
  }

  if (count($errors) == 0) {
      $db = new Database();
      $dbConn = $db->getConnection();

      // Prepare and execute the query to check if the department exists
      $stmt = $dbConn->prepare("SELECT `Department` FROM `department_tbl` WHERE `Department` = :department");
      $stmt->bindParam(':department', $unit);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
          $errors['unitExists'] = 'Unit already exists!';
      } else {
          // Assuming you are doing some database operations here to insert the new unit
          // For example:
          $stmt = $dbConn->prepare("INSERT INTO `department_tbl` (`Department`) VALUES (:department)");
          $stmt->bindParam(':department', $unit);
          $stmt->execute();

          if ($stmt->rowCount() > 0) {
              echo json_encode([
                  'status' => true,
                  'message' => $success
              ]);
              exit;
          } else {
              $errors['dbError'] = 'Failed to add the unit!';
          }
      }
  }

  if (count($errors) > 0) {
      echo json_encode([
          'status' => false,
          'errors' => $errors,
      ]);
  }
} */
/* if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $unit = htmlspecialchars($_POST['units']);

  //$sqlUnitExist = "SELECT `Depaertment` FROM `department_tbl` WHERE `Department` = ':department' ";

  if(empty(trim($unit))){
    $errors['emptyUnit'] = 'Unit is Required!';
  }

  if(count($errors) > 0){
    $db = new Database();
    $dbConn = $db->getConnection();
    $stmt = $dbConn->prepare("SELECT `Department` FROM `department_tbl` WHERE `Department` = :unit");
    $stmt->bindParam(':unit', $unit);
    $stmt->execute();
    $unitExist = $stmt->rowCount();

    if($stmt->rowCount() > 0) {
      $errors['unitExists'] = 'Unit already exists!';
    }else{

    }
  }
}
  if(count($errors) > 0){
    echo json_encode([
      'status' => false,
      'errors' => $errors,
    ]);
  }else{
    echo json_encode([
      'status' => true,
      'message' => $success
    ]); 
  } */