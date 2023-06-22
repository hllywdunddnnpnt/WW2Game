<?php
/*$db_user = "ww3game_user";
$db_pass = "password";
$db_database = "ww2game_db";*/
$db = mysqli_connect('localhost', $db_user, $db_pass);
if (!$db) {
	define("HAV_DB", false);
	die(mysqli_error($db));
}
if (!mysqli_select_db($db, $db_database)) {
	$str = mysqli_error($db);
	define("HAV_DB", false);
	if ($str) die($str);
}
?>