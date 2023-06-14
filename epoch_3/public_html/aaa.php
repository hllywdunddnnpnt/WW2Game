<?php


require_once('scripts/vsys.php');

$pass = "james123";
$apassword = md5($pass);
$password1 = md5($pass);

$user = new User();
	$user->username = "Johnny_3_Tears";
	$user->email    = "night_train_247@hotmail.com";
	$user->password = $password1;
	$user->nation   = 0;
	$user->active   = 1;
	$user->area     = $conf['area-count'];
	$id = $user->create();
	

?>