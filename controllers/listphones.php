<?php

$personid = $_GET["personid"];

$phones = array();

$stmt = $mysqli->prepare("SELECT phoneid, phone FROM phones WHERE personid = ? ORDER BY phoneid");
$stmt->bind_param("i", $personid);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $phones[] = $row;
}
$result->close();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($phones);