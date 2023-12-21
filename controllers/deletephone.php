<?php
require_once("lib.php");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$personid = $data["phoneid"];

$json = array();

$stmt = $mysqli->prepare("DELETE FROM phones WHERE phoneid = ?");
$stmt->bind_param("i", $personid);
$stmt->execute();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

return_json($json, 200);
