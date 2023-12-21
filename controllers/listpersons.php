<?php
require_once("lib.php");

$json = array();
$person = array();

$result = $mysqli->query("SELECT * FROM persons ORDER BY personid");
while ($row = $result->fetch_assoc()) {
    $persons[] = $row;
}
$result->close();
$json["persons"] = $persons;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
return_json($json, 200);