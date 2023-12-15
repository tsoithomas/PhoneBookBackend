<?php

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$fname = $data["fname"];
$lname = $data["lname"];

$stmt = $mysqli->prepare("INSERT INTO persons (fname, lname) VALUES (?,?)");
$stmt->bind_param("ss", $fname, $lname);
$stmt->execute();


$persons = array();
$result = $mysqli->query("SELECT * FROM persons ORDER BY personid");
while ($row = $result->fetch_assoc()) {
    $persons[] = $row;
}
$result->close();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($persons);
