<?php

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$phone = $data["phone"];
$personid = $data["personid"];

$stmt = $mysqli->prepare("INSERT INTO phones (personid, phone) VALUES (?,?)");
$stmt->bind_param("is", $personid, $phone);
$stmt->execute();


$phones = array();
$result = $mysqli->query("SELECT * FROM phones ORDER BY personid");
while ($row = $result->fetch_assoc()) {
    $phones[] = $row;
}
$result->close();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($phones);
