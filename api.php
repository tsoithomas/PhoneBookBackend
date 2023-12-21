<?php
require_once("sql.php");
require_once("lib.php");

$action = $_GET["action"];
$token = $_GET["token"];

purge_tokens();

switch ($action) {
	case "listpersons":
		verify_token($token);
		require_once("controllers/listpersons.php");
		break;
	case "createperson":
		verify_token($token);
		require_once("controllers/createperson.php");
		break;
	case "deleteperson":
		verify_token($token);
		require_once("controllers/deleteperson.php");
		break;
	case "listphones":
		verify_token($token);
		require_once("controllers/listphones.php");
		break;
    case "createphone":
		verify_token($token);
        require_once("controllers/createphone.php");
        break;
    case "deletephone":
		verify_token($token);
        require_once("controllers/deletephone.php");
        break;
	case "login":
		require_once("controllers/login.php");
		break;
    default:
		return_json(array(), 400);
}


