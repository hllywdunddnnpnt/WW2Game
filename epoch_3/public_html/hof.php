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

require_once('scripts/vsys.php');
require_once('scripts/Template.php');

new Privacy(PRIVACY_PUBLIC);

$t = new Template('hof', intval($cgi['t']));
$saveUser = false;

$filters = array(
	'age'   => FILTER_VALIDATE_INT,
	'uid'   => FILTER_VALIDATE_INT,
	'area'  => FILTER_VALIDATE_INT,
);

$filteredG = filter_input_array(INPUT_GET, $filters);

$age  = min(max(intval($filteredG['age']), 0), $current_age - 1);
$uid  = intval($filteredG['uid']);
$area = min(max(intval($filteredG['area']), 1), 3);
if (!$age) {
	$age = $current_age - 1;
}

$noages = true;
if ($noages) $age++;



/*
if ($age < 15) {
	$area = false;
} $area = true;

//$age = 1;

$WHERE = '';
if ($area and $age >= 15) {
	$WHERE = " WHERE area = $area ";
}*/

/*
$q = mysqli_query($db, "SELECT *, (sarank+darank+carank+rarank) as rave FROM hof$age $WHERE order by rave ASC") or die(mysqli_error($db));

$t->u = null;
$t->ranks = array();
while ($r = mysqli_fetch_object($q)) {
	$t->ranks[] = $r;
	if ($uid and $uid == $r->id) {
		$t->u = $r;
	}
}*/

$db_hof = select_db("ww3game_hof");
$results = mysqli_query($db_hof, "SELECT * FROM hof_$age ORDER BY `rank` ASC") or die(mysqli_error($db_hof));

$t->current_age = $current_age;
$t->age = $age;
$t->area = $area;
$t->user = $user;
$t->results = $results;
$t->pageTitle = 'Previous Age Stats';
$t->display();



?>
