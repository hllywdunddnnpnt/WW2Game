
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
<!-- Begin user stats -->

<div id="officers-list" class="panel">
	<div class="panel-title">
		Military Potential
	</div>
	<table class="tab-stats table-military">
		<tr>
			<th class="title stat">Stat</th>
			<th class="number amount">Amount</th>
			<th class="number rank">Rank</th>
		</tr>
		<tr>
			<td class="title stat">Offensive</td>
			<td class="number amount high"><?= numecho($user->SA) ?></td>
			<td class="number rank"><?= ($user->sarank ?  numecho($user->sarank) : '#') ?></td>
		</tr>
		<tr>
			<td class="title stat">Defensive</td>
			<td class="number amount high"><?= numecho($user->DA) ?></td>
			<td class="number rank"><?= ($user->darank ?  numecho($user->darank) : '#') ?></td>
		</tr>
		<tr>
			<td class="title stat">Covert</td>
			<td class="number amount high"><?= numecho($user->CA) ?></td>
			<td class="number rank"><?= ($user->carank ?  numecho($user->carank) : '#') ?></td>
		</tr>
		<tr>
			<td class="title stat">Retaliation</td>
			<td class="number amount high"><?= numecho($user->RA) ?></td>
			<td class="number rank"><?= ($user->rarank ?  numecho($user->rarank) : '#') ?></td>
		</tr>
	</table>
</div>
<!-- End user stats -->
