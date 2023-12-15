<?php

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$personid = $data["personid"];

$stmt = $mysqli->prepare("DELETE FROM persons WHERE personid = ?");
$stmt->bind_param("i", $personid);
$stmt->execute();

$stmt = $mysqli->prepare("DELETE FROM phones WHERE personid = ?");
$stmt->bind_param("i", $personid);
$stmt->execute();

$result = array("status" => "success");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($result);
