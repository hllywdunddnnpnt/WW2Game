
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
<!-- Begin online page -->
<div id="online-container">
	<div class="panel">
		<div class="panel-title">
			Users Online
		</div>
		<?php if (SHOW_ONLINE): ?>
			<table class="odd-even large">
				<tr>
					<th>Rank</th>
					<th>Nation</th>
					<th>Name</th>
					<th>Army Size</th>
				</tr>
				<?php foreach($this->users as $target) { ?>
					<?php if ($area != $target->area) { $area = $target->area;?>
						<tr><td colspan="4"><?= $conf['area'][$area]['name'] ?></td></tr>
					<?php } ?>
					<tr>
						<?php if ($target->rank == 0) { ?>
							<td>Unranked</td>
							<td><img title="<?= $target->getNation() ?>" alt="<?= $target->getNation() ?>" src="<?= $this->image($target->getNationFlag()) ?>" /></td>
							<td><?= $target->getNameHTML() ?></td>
							<td><?= numecho($target->getTFF()) ?></td>
						<?php }
							else { ?>
							<td><?= numecho($target->rank) ?></td>
							<td><img title="<?= $target->getNation() ?>" alt="<?= $target->getNation() ?>" src="<?= $this->image($target->getNationFlag()) ?>" /></td>
							<td style="text-align:left;">
								<?= $target->getNameLink('', true) ?>
								<?php if ($target->alliance) { echo $target->getAlliance()->getTag(); } ?>
							</td>
							<td><?= numecho($target->getTFF()) ?></td>
						<?php } ?>
					</tr>
				<?php } ?>
				<tr><td colspan="4"><?= numecho($this->usersCount) ?> online players</td></tr>
			</table>
		<?php else: ?>
			Online users are anonymous!
		<?php endif; ?>
	</div>
</div>
<!-- End online page -->
