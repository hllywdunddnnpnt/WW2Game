
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
<!-- Begin Armoury page -->
<div id="armoury-container">

	<form method="post">
		<h1 class="">
			Buy Weapons
		</h1>
		<div class="panel">
			<div class="panel-title">
				Attack Weapons
			</div>
			<table>
				<tr>
					<th width="25%" style="text-align:right;">Weapon</th>
					<th width="15%">Strength</th>
					<th width="15%">Cost</th>
					<th width="25%">Amount</th>
					<th width="20%">&nbsp;</th>
				</tr>
				<?php for ($i = 0; $i <= $user->salevel; $i++) { ?>
					<tr>
						<td style="text-align:right;"><?= $conf['names']['weapons'][1][$i] ?></td>
						<td style="text-align:center;"><?= numecho($conf['weapon' . $i . 'strength']) ?></td>
						<td style="text-align:center;"><?= numecho($conf['weapon' . $i . 'price']) ?></td>
						<td style="text-align:left;"><input type="text" name="attackweapon[]" value="0" id="attack-weapon-<?= $i ?>" /></td>
						<td style="text-align:left;"><input type="button" onclick="javascript:return attackWMax(<?= $i ?>, <?= $conf['weapon' . $i . 'price'] ?>);" value="Max" style="width: 60px;" /></td>
					</tr>
				<?php } ?>
			</table>
			<div class="panel-title">
				Defense Weapons
			</div>
			<table>
				<tr>
					<th width="25%" style="text-align:right;">Weapon</th>
					<th width="15%">Strength</th>
					<th width="15%">Cost</th>
					<th width="25%">Amount</th>
					<th width="20%">&nbsp;</th>
				</tr>
				<?php for ($i = 0; $i <= $user->dalevel; $i++) { ?>
					<tr>
						<td style="text-align:right;"><?= $conf['names']['weapons'][0][$i] ?></td>
						<td style="text-align:center;"><?= numecho($conf['weapon' . $i . 'strength']) ?></td>
						<td style="text-align:center;"><?= numecho($conf['weapon' . $i . 'price']) ?></td>
						<td style="text-align:left;"><input type="text" name="defenseweapon[]" value="0" id="defense-weapon-<?= $i ?>" /></td>
						<td style="text-align:left;"><input type="button" onclick="javascript:return defenseWMax(<?= $i ?>, <?= $conf['weapon' . $i . 'price'] ?>);" value="Max" style="width: 60px;" /></td>
					</tr>
				<?php } ?>
				<!-- <tr>
					<td colspan="4">&nbsp;</td>
					<td style="text-align:right;"><input type="submit" name="armoury-buy" value="Buy" /></td>
				</tr> -->
			</table>
		</div>
		<div class="form-sub-bottom">
			<input type="submit" class="btn-sub" name="armoury-buy" value="Buy" />
		</div>
	</form>

	
	<div class="panel" style="margin-top: 30px;">
		<h1 class="">
			Inventory
		</h1>
		<div class="panel-title">
			Current Attack Weapons
		</div>
		<table>
			<tr>
				<th width="25%">Weapon</th>
				<th width="15%">Quantity</th>
				<th width="30%">Strength</th>
				<th width="30%">Sell</th>
			</tr>
			<?php foreach ($this->saWeapons as $weapon) { ?>
				<tr>
					<td><?= $weapon->getName($user) ?></td>
					<td><?= numecho($weapon->weaponCount)?></td>
					<td>
					<?php if ($weapon->weaponStrength == $weapon->getFullStrength()) {?>
						<?= numecho($weapon->weaponStrength) ?> / <?= numecho($weapon->getFullStrength()) ?></td>
					<?php }
						else { ?>
						<form method="post">
							<input type="hidden" name="wId" value="<?= $weapon->id ?>" />
							<input style="width: 35px;" type="text" name="damage" value="<?= $weapon->getDamage() ?>" />
							<input type="submit" name ="repair-attack" value="<?= numecho($weapon->getRepairPerPoint()) ?> gold / point" />
							<input type="submit" name="repair-attack-max" value="Max" />
						</form>
						<?php } ?>
					<td>
						<form method="post">
							<input type="hidden" name="wId" value="<?= $weapon->id ?>" />
							<input style="width: 60px;" type="text" name="sell" value="0" />
							<input type="submit" value="Sell for <?= numecho($weapon->getSellCost($user)) ?>" />
						</form>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>Total: <?= numecho($this->saRatio->total) ?><br>Ratio: <?= number_format(round($this->saRatio->ratio, 2)) ?></td>
				<td>
					<?php if (true/*$user->supporter*/) { ?>
						<form method="post">
							<input type="submit" value="Repair All" name="repair-all-attack" style="float: right;" />
						</form>
					<?php } else { echo "&nbsp;"; } ?>
				</td>
				<td>
					<?php if (false/*$user->supporter*/) { ?>
						<form method="post">
							<input type="submit" value="Sell All" name="sell-all-attack" style="float: right;" />
						</form>
					<?php } else { echo "&nbsp;"; } ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="panel">
		<div class="panel-title">
			Current Defense Weapons
		</div>
		<table>
			<tr>
				<th width="25%">Weapon</th>
				<th width="15%">Quantity</th>
				<th width="30%">Strength</th>
				<th width="30%">Sell</th>
			</tr>
			<?php foreach ($this->daWeapons as $weapon) { ?>
				<tr>
					<td><?= $weapon->getName($user) ?></td>
					<td><?= numecho($weapon->weaponCount) ?></td>
					<td>
					<?php if ($weapon->weaponStrength == $weapon->getFullStrength()) {?>
						<?= numecho($weapon->weaponStrength) ?> / <?= numecho($weapon->getFullStrength()) ?></td>
					<?php }
						else { ?>
							<form method="post">
								<input type="hidden" name="wId" value="<?= $weapon->id ?>" />
								<input style="width: 35px;" type="text" name="damage" value="<?= $weapon->getDamage() ?>" />
								<input type="submit" name="repair-defense" value="<?= numecho($weapon->getRepairPerPoint()) ?> gold / point" />
								<input type="submit" name="repair-defense-max" value="Max" />
							</form>
						<?php } ?>
					<td>
						<form method="post">
							<input type="hidden" name="wId" value="<?= $weapon->id ?>" />
							<input style="width: 60px;" type="text" name="sell" value="0" />
							<input type="submit" value="Sell for <?= numecho($weapon->getSellCost($user)) ?>" />
						</form>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td>&nbsp;</td>
				<td>Total: <?= numecho($this->daRatio->total) ?><br>Ratio: <?= number_format(round($this->daRatio->ratio, 2)) ?></td>
				<td>
					<?php if (true/*$user->supporter*/) { ?>
						<form method="post">
							<input type="submit" value="Repair All" name="repair-all-defense" style="float: right;" />
						</form>
					<?php } else { echo "&nbsp;"; } ?>
				</td>
				<td>
					<?php if (false/*$user->supporter*/) { ?>
						<form method="post">
							<input type="submit" value="Sell All" name="sell-all-defense" style="float: right;" />
						</form>
					<?php } else { echo "&nbsp;"; } ?>
				</td>
			</tr>
		</table>
	</div>

</div>
<!-- End Armoury Page -->
