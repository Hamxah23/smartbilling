<?php
require_once __DIR__ . '/../database/Database.php';

################### insert product price #########################
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $product = htmlspecialchars($_POST['productName']);
  $price = htmlspecialchars($_POST['price']);
  $department = htmlspecialchars($_POST['department']);

  $errors = [];
  $success = [];

  if(empty(trim($product))){
    $errors['product'] = 'Product service is required!';
  }
  if(empty(trim($price))){
    $errors['price'] = 'Price is required!';
  }
  if($department == '--choose--') {
    $errors['department'] = 'Department is required!';
  }
  
  if(empty($errors)){
    $db = new Database();
    $dbconn = $db->getConnection();
    $stmt = $dbconn->prepare("INSERT INTO `product_tbl` (`Department`, `Productname`, `Price`) VALUES (:department, :product, :price)");
    $stmt->bindValue(':department', $department, PDO::PARAM_STR);
    $stmt->bindValue(':product', $product, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    $result = $stmt->execute();
    if($result){
      $success['success'] = 'Service added successfully!';
    }else{
      $errors['dbFailure'] = 'Failed insert record';
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

#################### fetch departmentTable #####################
$counter = 1;
$db = new Database();
$dbConn = $db->getConnection();
$sqlDepartment = "SELECT * FROM `department_tbl` WHERE Status = 'Active'";
$resultDepartment = $db->query($sqlDepartment)->fetchAll();

#################### fetch productTable ########################
$sqlProduct = "SELECT * FROM `product_tbl`"; //JOIN `department_tbl`  WHERE `department_tbl`.`deptID` = '$pro[Department]' 
$resultProduct = $db->query($sqlProduct)->fetchAll();
