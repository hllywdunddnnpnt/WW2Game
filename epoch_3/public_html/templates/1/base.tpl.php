
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
<!-- Begin base page -->
<div id="base-container">
	<table style="width: 100%; vertical-align: top;">
		<tr>
			<td id="left-pane" style="width: 50%;">
				<div id="officers-list" class="panel">
					<div class="panel-title">
						User Info
					</div>
					<table class="tab-stats table-details">
						<tr>
							<td class="title">Name</td>
							<td class="amount"><?= $user->getNameLink() ?></td>
						</tr>
						<!--<tr><td>Social</td>
							<td><fb:login-button v="2" size="medium" onlogin="window.location.reload(true);">Connect</fb:login-button>
							</td>
						</tr>-->
						<!-- <tr>
							<td class="title">Supporter Level</td>
							<td class="amount"><a href="support.php"><?= ($user->supporter? "\$$user->supporter" : 'Become A Supporter') ?></a><td>
						</tr> -->
						<tr><td class="title">Email</td><td class="amount"><?= $user->email ?></td></tr>
						<tr><td class="title">Nation</td><td class="amount"><?= $user->getNation() ?></td></tr>
						<tr><td class="title">Rank</td><td class="amount"><?= numecho($user->rank) ?></td></tr>
						<?php if (AREAS): ?><td class="title">Area</td><td class="amount"><?= $user->getAreaName() ?></td></tr><?php endif; ?>
						<tr><td class="title">Commander</td><td class="amount">
							<?php if ($user->commander) { ?>
								<?= $user->getCommander()->getNameLink() ?>
								[<a href="base.php?leave-commander=yes"> leave </a>]
							<?php }
								else { ?>
								None
							<?php } ?>
						</td></tr>
						<tr><td class="title">Alliance</td><td class="amount">
							<?php if ($user->alliance > 0) { ?>
								<a href="alliance-home.php?"><?= $user->getAlliance()->getNameHTML() ?></a>
								[<a href="alliance-home.php?leave-alliance=yes"> leave </a>]
							<?php }
								else { ?>
								<a href="alliance-list.php">None</a>
							<?php } ?>
						</td></tr>
						<tr><td class="title">Game Skill</td><td class="amount"><?= numecho($user->gameSkill) ?></td></tr>
					</table>
					<div class="panel-title">
						Stats
					</div>
					<table class="tab-stats table-details">
						<tr><td class="title gold">Gold</td><td class="amount gold"><?= numecho($user->gold) ?> </td></tr>
						<tr><td class="title">Attack Turns</td><td class="amount"><?= numecho($user->attackturns) ?></td></tr>
						<tr><td class="title">Click Credits</td><td class="amount"><?= $user->gclick ?></td></tr>
						<tr><td class="title gold">Bank</td><td class="amount gold"><?= numecho($user->bank) ?> </td></tr>
					</table>
					<div class="panel-title">
						Productions
					</div>
					<table class="tab-stats table-details">
						<tr><td class="title bgold">Turn Based Gold</td>
							<td class="amount bgold"><span class="bgold"><?= numecho($user->getIncome()) ?> gold</span> 
								<span class="fade">p/turn</span></td></tr>
						<tr><td class="title bgold2">Commander Bonus</td>
							<td class="amount bgold2"><?php numecho($user->commandergold) ?> 
								<span class="fade">p/turn</span></td></tr>
					</table>
				</div>
			</td>
			<td id="right-pane" style="width: 50%;">
				<?php $this->load('user-stats') ?>
				<?php $this->load('personnel') ?>
				<div class="panel">
					<div class="panel-title">
						Upgrades
					</div>
					<table class="tab-stats table-details">
						<tr><td class="title">Defensive Tech</td><td class="amount"><?= $user->getDAName() ?></td></tr>
						<tr><td class="title">Offensive Tech</td><td class="amount"><?= $user->getSAName() ?></td></tr>
						<tr><td class="title">Covert Tech</td><td class="amount"><?= $user->calevel ?></td></tr>
						<tr><td class="title">Retaliation Tech</td><td class="amount"><?= $user->ralevel ?></td></tr>
						<tr><td class="title">Hand-to-hand Level</td><td class="amount"><?= $user->hhlevel ?></td></tr>
						<tr>
							<td class="title">Unit Production</td>
							<td class="amount"><?= numecho($user->up) ?> (+ <?php numecho($user->getOfficerUP());echo ' +';numecho($user->getAllianceUP()); ?>)</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php $this->load('officers-list') ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php if($user->clickall == 0) {?>
                	<form method="POST">
                		<input type="submit" name="clickall" value="Global Click" /><br>
                		<small>Adds 10 soldiers to everyone.</small>
                	</form>
                <?php } ?>
			</td>
		</tr>
	</table>
</div>
<!-- End base page -->
