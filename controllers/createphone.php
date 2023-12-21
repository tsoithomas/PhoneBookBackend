<?php
require_once("lib.php");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$phone = $data["phone"];
$personid = $data["personid"];

$stmt = $mysqli->prepare("INSERT INTO phones (personid, phone) VALUES (?,?)");
$stmt->bind_param("is", $personid, $phone);
$stmt->execute();

$json = array();
$phones = array();
$stmt = $mysqli->prepare("SELECT phoneid, phone FROM phones WHERE personid = ? ORDER BY phoneid");
$stmt->bind_param("i", $personid);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $phones[] = $row;
}
$result->close();
$json["phones"] = $phones;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
return_json($json, 200);