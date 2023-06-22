<!--

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

-->
<!-- Begin Offline page -->
<?php global $_AGE, $_START_TIME, $_END_TIME; ?>
<!--
<?php
$d = false;

if ($d) {
	var_dump($_AGE);
	var_dump($_START_TIME);
	var_dump($_END_TIME);
}

$nextage = $_AGE+1;

$starttime = intval(str_replace('@', '', $_START_TIME[$nextage]));
$endtime   = intval(str_replace('@', '', $_END_TIME[$nextage]));

if ($d) {
	echo sprintf("current time ($nextage): %i %s\n", time(), date('r', time()));
	echo sprintf("start time ($nextage): %i %s\n", $starttime, date('r', $starttime));
	echo sprintf("end time ($nextage): %i %s\n", $endtime, date('r', $endtime));

	if (time() > $starttime) {
		echo "time for next age " . time() - $starttime . "\n";
	}
	else {
		echo "there are still " . ($starttime - time()) / 60 . ' minutes left';
	}
}

// FIX for issue #1 : if not set, then make it 24 hours from now
if (!isset($_START_TIME[$nextage])) {
	$starttime = time() + (24 * 60 * 60);
}

?>
-->
<div id="offline-container">
	<p>Thank you for playing Age <?= $_AGE ?> of World War II.</p>
    <p>The Age has ended the game is under the process of resetting the game for a new Age.</p>
	<p>The new Age will start in <b><?= ceil(($starttime - time()) / 60) ?> minutes</b>, the game will be down in the meantime.</p>
</div>
<!-- End offline page -->

