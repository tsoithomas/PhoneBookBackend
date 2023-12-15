<?php

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$personid = $data["phoneid"];

$stmt = $mysqli->prepare("DELETE FROM phones WHERE phoneid = ?");
$stmt->bind_param("i", $personid);
$stmt->execute();

$result = array("status" => "success");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($result);
