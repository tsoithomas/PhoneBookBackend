<?php

$person = array();

$result = $mysqli->query("SELECT * FROM persons ORDER BY personid");
while ($row = $result->fetch_assoc()) {
    $persons[] = $row;
}
$result->close();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

echo json_encode($persons);
