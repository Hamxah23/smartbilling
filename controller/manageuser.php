<?php
require_once __DIR__ . '/../database/Database.php';

$db = new Database();
$dbConn = $db->getConnection();

##################### fetch department #################
$sqlDepartment = "SELECT * FROM `department_tbl` WHERE Status = 'Active'";
$resultDepartment = $db->query($sqlDepartment)->fetchAll();
######################## uses ##########################
$counter = 1;
$sqlUsers = $dbConn->query("SELECT * FROM `users_tbl`")->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__. '/../views/manageuser.view.php';