<?php
$db = mysqli_pconnect('localhost', $db_user, $db_pass);
if (!$db) {
	define("HAV_DB", false);
	die(mysqli_error($db));
}
if (!mysqli_select_db($db_database, $db)) {
	$str = mysqli_error($db);
	define("HAV_DB", false);
	if ($str) die($str);
}
?>