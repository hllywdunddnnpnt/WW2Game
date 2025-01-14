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

$incron = 1;
require_once('scripts/vsys.php');

$move = array(
	1 => array(),
	2 => array(),
	3 => array()
);

// Get all the people in Europe that need to move down
$q = mysqli_query($db, 'SELECT * FROM `User` WHERE `area`=1 AND `active`=1 AND `rank`>' . $conf['users-per-page']) or die (mysqli_error($db));
$i = 0;
while ($r = mysqli_fetch_object($q)) {
    $move[2][] = $r->id;
    $i++;
}

print "Moving $i from Europe down\n";

// Get all the people in Africa that need to move up
$q = mysqli_query($db, 'SELECT * FROM `User` WHERE `area`=2 AND `active`=1 AND `rank` <= ' . ($conf['users-per-page'] * 2)) or die (mysqli_error($db));
$i = 0;
while ($r = mysqli_fetch_object($q)) {
    $move[1][] = $r->id;
    $i++;
}
print "Moving $i from Africa up\n";

// Get all the people in Africa that need to move down
$q = mysqli_query($db, 'SELECT * FROM `User` WHERE `area`=2 AND `active`=1 ORDER BY rank DESC LIMIT ' . ($conf['users-per-page'] * 2)) or die (mysqli_error($db));
$i = 0;
while ($r = mysqli_fetch_object($q)) {
    $move[3][] = $r->id;
    $i++;
}
print "Moving $i from Africa down\n";

// Get all the people in Graveyard that need to move up
$q = mysqli_query($db, 'SELECT * FROM `User` WHERE `area`=3 AND `active`=1 AND `rank `<= ' . ($conf['users-per-page'] * 2)) or die (mysqli_error($db));
$i = 0;
while ($r = mysqli_fetch_object($q)) {
    $move[2][] = $r->id;
    $i++;
}
print "Moving $i from Graveyard up\n";

//print_r($move);

//echo "select id, username,rank,area from User where id in (" . implode(',', $move[2]) . ") order by area asc, rank asc";

$q = mysqli_query($db, 'UPDATE `User` SET `area`=1 WHERE active=1 AND `id` IN (' . implode(',', $move[1]) . ')') or die(mysqli_error($db));
$q = mysqli_query($db, 'UPDATE `User` SET `area`=2 WHERE active=1 AND `id` IN (' . implode(',', $move[2]) . ')') or die(mysqli_error($db));
$q = mysqli_query($db, 'UPDATE `User` SET `area`=3 WHERE active=1 AND `id` IN (' . implode(',', $move[3]) . ')') or die(mysqli_error($db));
?>
