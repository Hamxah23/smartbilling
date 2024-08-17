<?php
require_once __DIR__ . '/../database/Database.php';

$db = new Database();
$dbConn = $db->getConnection();



$sqlusers = $dbConn->query("SELECT * FROM `users_tbl`")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode(["data" => $sqlusers]);
