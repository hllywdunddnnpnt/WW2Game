
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
<!-- Begin officers list -->
<div id="officers-list" class="panel">
	<div class="panel-title">
		Officers
	</div>
	<table>
		<tr>
			<th>Name</th>
			<th>Army</th>
			<th>Area</th>
			<th>Rank</th>
			<?php $col1 = 3; $col2 = 1; ?>
			<?php if (me($user->id)) { // $user might be the person we're looking at ?>
				<?php $col1 = 6; $col2 = 4; ?>
				<th>Unit Production</td>
				<th>Last Active</th>
				<th>Kick/Accept</th>
			<?php } ?>
		</tr>
		<?php
			$count = $user->getOfficersCount();
			$page = intval($_GET['officer-list-page']);
			$page = $page ? $page : 1;
			$totalPages = ceil($count / $conf['officers-per-page']);
			$prev = 0;
			$next = 0;
			if ($page < $totalPages) {
				$next = $page + 1;
			}
			if ($page > 1) {
				$prev = $page - 1;
			}
		?>

		<?php if ($count > 0) { ?>
			<?php $officers = $user->getOfficers(max($page, 1));
			foreach ($officers as $officer) { ?>
				<tr>
					<td>
						<?= $officer->getNameLink() ?>
					</td>
					<td><?= numecho($officer->getTFF())     ?></td>
					<td><?= $officer->getAreaNameShort()    ?></td>
					<td><?= numecho($officer->rank)         ?></td>
					<?php if (me($user->id)) { ?>
						<td><?= numecho($officer->up) ?></td>
						<td><?= date('G:s:i M jS', $officer->lastturntime)  ?></td>
						<td>
							<?php if ($officer->accepted) { ?>
								<a href="base.php?kick-officer=<?= $officer->id ?>">Kick</a>
							<?php }
								else { ?>
								<a href="base.php?accept-officer=<?= $officer->id ?>">Accept</a>
							<?php } ?>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
		<?php }
			else { ?>
			<tr><td colspan="<?= $col1 ?>">No Officers</td></tr>
		<?php } ?>
		

		<tr>
			<td>
				<?php if ($prev > 0) { ?>
					<a href="?officer-list-page=<?= $prev ?>&<?= $this->offargs ?>">&lt;&lt; prev</a>
				<?php }
					else {
						echo '&nbsp;';
					}
				?>
			</td>
			<td colspan="<?= $col2 ?>">
				<?= numecho($count); ?> / <?= numecho($user->maxofficers) ?> officers | page <?= $page ?> of <?= $totalPages ?>
			</td>
			<td>
				<?php if ($next > 0) { ?>
					<a href="?officer-list-page=<?= $next ?>&<?= $this->offargs ?>">next &gt;&gt;</a>
				<?php }
					else {
						echo '&nbsp;';
					}
				?>
			</td>
		</tr>
	</table>
</div>
<!-- End officers list -->
