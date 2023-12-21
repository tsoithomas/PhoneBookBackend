<?php
require_once("sql.php");

function return_json($json, $code) {
	$json["status"] = $code;

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");

	echo json_encode($json, JSON_PRETTY_PRINT);
	exit();
}


function verify_token($token) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT accountid FROM tokens WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    
    $result = $stmt->get_result();

    $json = array();
    if ($result->num_rows == 0)
        return_json($json, 401);

    list($accountid) = $result->fetch_row();
    $result->close();

    return $accountid;
}

function purge_tokens() {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM tokens WHERE time_create < DATE_ADD(NOW(), INTERVAL -1 HOUR)");
    $stmt->bind_param("s", $token);
    $stmt->execute();
}