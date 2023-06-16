<?php


require_once('scripts/vsys.php');

$pass = "james123";
$apassword = md5($pass);
$password1 = md5($pass);

$user = new User();
	$user->username = "FortRoyal";
	$user->email    = "fort-royal@hotmail.com";
	$user->password = $password1;
	$user->nation   = 2;
	$user->active   = 1;
	$user->area     = $conf['area-count'];
	$id = $user->create();
	

?>