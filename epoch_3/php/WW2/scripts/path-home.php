<?php
//define('HOME', '/var/www/ww2game-3.j3t-games.com/');
$HOME = "";
if (isset($incron) && $incron === true)
{
    $HOME = isset($_SERVER) && isset($_SERVER["SERVER_NAME"]) ? $_SERVER["DOCUMENT_ROOT"]: '/var/www/ww2game-3.j3t-games.com/public_html';
    //define('HOME', $_SERVER["SERVER_NAME"] == $host_local ? "/" : "/var/www/$host_server/");
}
else
{
    $HOME = isset($_SERVER) && isset($_SERVER["DOCUMENT_ROOT"]) ? $_SERVER["DOCUMENT_ROOT"] : '/var/www/ww2game-3.j3t-games.com/public_html';
}

//$HOME = implode('/', explode('/', $HOME, -1));
if (substr($HOME,-11,11) == "public_html") $HOME = substr($HOME,0,-11);
define('HOME', $HOME);

$host_local = "ww2game-epoch3.git";
$host_server = "ww2game-3.j3t-games.com";

define('BASEURL', isset($_SERVER) && isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] == $host_local ? "http://$host_local" : "https://$host_server");
