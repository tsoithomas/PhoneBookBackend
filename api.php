<?php
require_once("sql.php");

$action = $_GET["action"];


switch ($action) {
	case "listpersons":
		require_once("controllers/listpersons.php");
		break;
	case "getperson":
		require_once("controllers/getperson.php");
		break;
	case "createperson":
		require_once("controllers/createperson.php");
		break;
	case "delperson":
		require_once("controllers/delperson.php");
		break;
	default:
		die("Error");
}

