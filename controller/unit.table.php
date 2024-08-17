<?php
require_once __DIR__ . '/../database/Database.php';

$db = new Database();
$dbconn = $db->getConnection();

$stmt = $dbconn->query("SELECT * FROM `department_tbl`")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode(['data' => $stmt]);