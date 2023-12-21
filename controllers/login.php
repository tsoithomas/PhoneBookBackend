<?php
require_once("lib.php");

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$username = $data["username"];
$password = $data["password"];

$json = array();

$stmt = $mysqli->prepare("SELECT accountid FROM accounts WHERE `username`=? AND `password`=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) 
	return_json($json, 400);

list($accountid) = $result->fetch_row();
$token = bin2hex(random_bytes(64));

$stmt = $mysqli->prepare("INSERT INTO tokens (token, accountid) VALUES(?,?)");
$stmt->bind_param("si", $token, $accountid);
$stmt->execute();

$json["token"] = $token;

$result->close();

return_json($json, 200);


