<?php
require_once __DIR__.'/../database/Database.php';

$db = new Database();
$dbConn = $db->getConnection();
$errors = [];
$success = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fname = htmlspecialchars($_POST['userFullname']);
	$email = htmlspecialchars($_POST['email']);
	$phone = htmlspecialchars($_POST['phone']);
	$department = htmlspecialchars($_POST['department']);
	$role = htmlspecialchars($_POST['role']);

	$stmt = $dbConn->prepare("SELECT `Email` FROM `users_tbl` WHERE `Email` = :email");
	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	$emailExist = $stmt->rowCount();

	$stmtphone = $dbConn->prepare("SELECT `Phone` FROM `users_tbl` WHERE `Phone` = :phone");
	$stmtphone->bindValue(':phone', $phone, PDO::PARAM_INT);
	$stmtphone->execute();
	$phoneExist = $stmtphone->rowCount();
	
	if($emailExist > 0){
		$errors['emailExist'] = 'Email address already exist!';
	}
	if($phoneExist > 0){
		$errors['phoneExist'] = 'Phone number already exist!';
	}
	if(empty(trim($fname))) {
		$errors['fname'] = 'Fullname is required!';
	}
	if(empty(trim($email))) {
		$errors['email'] = 'Email is required!';
	}
	if (empty(trim($phone))) {
		$errors['phone'] = 'Phone is required!';
	}
	if($department == '--choose--') {
		$errors['department'] = 'Department is required!';
	}
	if($role == '--choose--'){
		$errors['role'] = 'Role is required!';
	}

	if(empty($errors)){
		$stmt = $dbConn->prepare("INSERT INTO `users_tbl` (`Fullname`, `Email`, `Phone`,`Department`, `Role`) VALUES (:fname, :email, :phone, :department, :userRore) ");
		$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindValue(':department', $department, PDO::PARAM_STR);
		$stmt->bindValue(':userRore', $role, PDO::PARAM_STR);

		$result = $stmt->execute();

		if($result){
			$success['success'] = 'User added successfully!';
		}else{
			$errors['database'] = 'Failed to add user!';
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