
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
<!-- Begin user personnel -->

<div id="officers-list" class="panel">
	<div class="panel-title">
		Personnel
	</div>
	<table class="tab-stats table-personnel">
		<tr>
			<th class="title unit">Unit</th>
			<th class="number quantity">Quantity</th>
		</tr>
		<tr>
			<td class="title unit high">Untrained</td>
			<td class="number quantity high"><?= numecho($user->uu) ?></td>
		</tr>
		<tr>
			<td class="title unit">Offensive Soldiers</td>
			<td class="number quantity"><?= numecho($user->sasoldiers) ?></td>
		</tr>
		<tr>
			<td class="title unit">Offensive Mercenaries</td>
			<td class="number quantity"><?= numecho($user->samercs) ?></td>
		</tr>
		<tr>
			<td class="title unit">Defensive Soldiers</td>
			<td class="number quantity"><?= numecho($user->dasoldiers) ?></td>
		</tr>
		<tr>
			<td class="title unit">Defensive Mercenaries</td>
			<td class="number quantity"><?= numecho($user->damercs) ?></td>
		</tr>
		<tr>
			<td class="title unit">Spies</td>
			<td class="number quantity"><?= numecho($user->spies) ?></td>
		</tr>
		<tr>
			<td class="title unit">Special Forces</td>
			<td class="number quantity"><?= numecho($user->specialforces) ?></td>
		</tr>
		<tr>
			<td class="title unit b high">Total</td>
			<td class="number quantity b high"><?= numecho($user->getTFF()) ?></td>
		</tr>
	</table>
</div>
<!-- End user personnel -->
