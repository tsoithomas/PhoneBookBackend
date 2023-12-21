<?php
require_once("lib.php");

$personid = $_GET["personid"];

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