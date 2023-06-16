<?php
/***

    World War II MMORPG
    Copyright (C) 2009-2010 Richard Eames

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

***/

$db = mysqli_connect('localhost',  $db_user, $db_pass);
if (!$db) {
	
	define("HAV_DB",false);
	die (mysqli_error($db));
}
if (!mysqli_select_db($db, $db_database)) {
	$str=mysqli_error($db);
	define("HAV_DB",false);
	if ($str)	die($str);
} 

mysqli_query($db, "SET NAMES 'utf8'") or die(mysqli_error($db));
?>
