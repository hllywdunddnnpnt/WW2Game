
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
<!-- Begin upgrades page -->
<div id="upgrades-container">
	<div class="panel">
		<div class="panel-title">
			Technology Upgrades
		</div>
		<form method="post">
			<!-- How I hate tables for layout -->
			<table class="tab-stats table-upgrades">
				<tr>
					<th class="upgrade">Upgrade</th>
					<th class="current">Current</th>
					<th class="next">Next</th>
				</tr>
				<tr>
					<td class="upgrade">Offensive Technology</td>
					<td class="current"><?= $user->getSAName() ?></td>
					<td class="next">
						<?php if ($user->salevel >= $conf['race'][$user->nation]['max-salevel']) { ?>
							[ No More ]
						<?php }
							else { ?>
							<input type="submit" class="btn-upgrade" name="upgrade-sa" value="<?= numecho(Upgrades::saCost($user)) ?> Gold" />
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="upgrade">Defensive Technology</td>
					<td class="current"><?= $user->getDAName() ?></td>
					<td class="next">
						<?php if ($user->dalevel >= $conf['race'][$user->nation]['max-dalevel']) { ?>
							[ No More ]
						<?php }
							else { ?>
							<input type="submit" class="btn-upgrade" name="upgrade-da" value="<?= numecho(Upgrades::daCost($user)) ?> Gold" />
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="upgrade">Covert Technology</td>
					<td class="current"><?= $user->calevel ?></td>
					<td class="next"><input type="submit" class="btn-upgrade" name="upgrade-ca" value="<?= numecho(Upgrades::caCost($user)) ?> Gold" /></td>
				</tr>
				<tr>
					<td class="upgrade">Retaliation Technology</td>
					<td class="current"><?= $user->ralevel ?></td>
					<td class="next"><input type="submit" class="btn-upgrade" name="upgrade-ra" value="<?= numecho(Upgrades::raCost($user)) ?> Gold" /></td>
				</tr>
				<tr>
					<td class="upgrade">Upgrade Unit Production</td>
					<td class="current"><?= numecho($user->up) ?></td>
					<td class="next">
						<input type="submit" class="btn-upgrade" name="upgrade-up" value="<?= numecho(Upgrades::upCost($user)) ?> Gold" />
						<input type="submit" class="btn-max" name="upgrade-up-max" value="Max" style="float: right;" />
					</td>
				</tr>
				<tr>
					<td class="upgrade">Hand-to-Hand Training</td>
					<td class="current"><?= $user->hhlevel ?></td>
					<td class="next"><input type="submit" class="btn-upgrade" name="upgrade-hh" value="<?= numecho(Upgrades::hhCost($user)) ?> Gold" /></td>
				</tr>
				<?php if (false/*$user->getSupport('upgrades')*/) { ?>
					<tr>
						<td>Upgrade Officer Limit</td>
						<td><?= $user->maxofficers ?></td>
						<td><input type="submit" class="btn-upgrade" name="upgrade-of" value="<?= numecho(Upgrades::ofCost($user)) ?> Gold" /></td>
					</tr>
					<tr>
						<td>Upgrade Bank Deposit Percentage</td>
						<td><?= $user->bankper ?>%</td>
						<td><input type="submit" class="btn-upgrade" name="upgrade-bk" value="<?= numecho(Upgrades::bkCost($user)) ?> Gold" /></td>
					</tr>
				<?php } ?>
			</table>
		</form>
	</div>
</div>
<!-- End upgrades page -->
