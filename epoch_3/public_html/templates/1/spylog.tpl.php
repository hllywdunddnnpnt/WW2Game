
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
<?php
	$pngt = pngt('%s spy', '%s spies', $this->s->spies);
	
?>

<!-- Begin Spy log page -->
<div id="spylog-container">	
	<div class="panel">
		<?php if ($this->s->isSuccess == 0) { ?>
			<!-- failed log -->
			<div class="panel-title">
				Failed Covert Mission Report
			</div>
			<div class="large">
				<p>Under the cover of night <?= $pngt ?> from
				<?= $this->attacker->getNameLink() ?>
				<?= ngt('sneaks', 'sneak', $this->s->spies) ?> into the
					camp of <?= $this->target->getNameLink() ?>.
				</p>
				<p>As they approach an alarm is triggered. <?= pngt('%s spy', '%s spies', $this->s->uu) ?> are quickly rounded up and executed</p>
				<?php if ($user->admin) { ?>
					<p><?= $this->s->SA ?></p>
				<?php } ?>
			</div> 
		<?php }
			else { ?>
			<?php if ($this->s->type == 0) { ?>
				<!-- spy log -->
				<div class="panel-title">
					Covert Mission Report
				</div>
				<div class="large">
					<p>Under the cover of night <?= $pngt ?> from
				<?= $this->attacker->getNameLink() ?>
				<?= ngt('sneaks', 'sneak', $this->s->spies) ?> into the
					camp of <?= $this->target->getNameLink() ?>.
				</p>
					<p>The <?= $pngt ?> are able to <b>successfully</b> gather important documents, this is what they learnt:</p>
				
					<table width="100%" class="table_lines" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<th colspan="4" align="center">Army Size:</th>
						</tr>
						<tr>
							<th class="subh">Unit Type</th>
							<th class="subh">Attack Specialist</th>
							<th class="subh">Defense Specialist</th>
							<th class="subh">Untrained</th>
						</tr>
						<tr>
							<td>Mercenaries</td>
							<td><?= $this->s->samercs ?></td>
							<td><?= $this->s->damercs ?></td>
							<td>--</td>
						</tr>
						<tr>
							<td>Soldiers</td>
							<td><?= $this->s->sasoldiers ?></td>
							<td><?= $this->s->dasoldiers ?></td>
							<td><?= $this->s->uu         ?></td>
						</tr>
						<tr>
							<td>Spies</td>
							<td colspan="3"><?= $this->s->targetSpies ?></td>
						</tr>
						<tr>
							<td>Special Forces</td>
							<td colspan="3"><?= $this->s->sf ?></td>
						</tr>
					</table>
					
					<div class="line">
						<label>Attack Potential</label>
						<span><?= $this->s->SA ?></span>
					</div>
					
					<div class="line">
						<label>Defense Potential</label>
						<span><?= $this->s->DA ?></span>
					</div>
					
					<div class="line">
						<label>Offensive Technology</label>
						<span><?= $this->s->salevel ?></span>
					</div>
					
					<div class="line">
						<label>Defensive Technology</label>
						<span><?= $this->s->dalevel ?></span>
					</div>
					
					<div class="line">
						<label>Covert Technology</label>
						<span><?= $this->s->calevel ?></span>
					</div>
					
					<div class="line">
						<label>Retaliation Technology</label>
						<span><?= $this->s->ralevel ?></span>
					</div>
					
					<div class="line">
						<label>Hand-to-Hand Technology</label>
						<span><?= $this->s->hhlevel ?></span>
					</div>
					
					<div class="line">
						<label>Unit Production</label>
						<span><?= $this->s->unitProduction ?></span>
					</div>
					
					<div class="line">
						<label>Attack Turns</label>
						<span><?= $this->s->attackTurns ?></span>
					</div>
					
					<div class="line">
						<label>Gold</label>
						<span><?= $this->s->gold ?></span>
					</div>
					
					<div class="clear flat"></div>
					
					<table width="100%" class="table_lines" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<th colspan="4">Weapons</th>
						</tr>
						<tr>
							<th class="subh">Name</th>
							<th class="subh">Type</th>
							<th class="subh">Quantity</th>
							<th class="subh">Strength</th>
						</tr>
						<?php
							$weaponA = explode(";", $this->s->weapons);
							$typesA = explode(";", $this->s->types);
							$types2A = explode(";", $this->s->types2);
							$quantitiesA = explode(";", $this->s->quantities );
							$strengthsA = explode(";", $this->s->strengths );
							$allStrengthsA = explode(";", $this->s->allStrengths );
						?>
						<?php if ($this->s->weapons) { ?>
							<?php for ($i = 0; $i < count($weaponA); $i++){ ?>
								<tr>
									<td>
										<?php if ($weaponA[$i] == '???') {
											echo $weaponA[$i];
										}
										else {
											echo $conf['names']['weapons'][$types2A[$i]][$weaponA[$i]];
										}?>
									</td>
									<td>
										<?php if ($typesA[$i] == '???') {
											echo $typesA[$i];
										}
										else {
											echo (($typesA[$i])?"Attack":"Defense");
										}?>
									</td>
									<td><?= $quantitiesA[$i] ?></td>
									<td><?= $strengthsA[$i] ?> / <?= $allStrengthsA[$i] ?></td>
								</tr>
							<?php } ?>
						<?php }
						else {?>
							<tr><td align="center" colspan="4">No Weapons</td></tr>
						<?php } ?>
					</table>
				</div> 
			<?php }
				else { ?>
				<!-- theft log -->
				<div class="panel-title">
					Theft Report
				</div>
				<div class="large">
					<p>Under the cover of night <?= $pngt ?> from
					<?= $this->attacker->getNameLink() ?>
					<?= ngt('sneaks', 'sneak', $this->s->spies) ?> into the
						camp of <?= $this->target->getNameLink() ?>.
					</p>
					<p>The <?= $pngt ?> were able to steal:</p>
					<?php if ($this->s->type == 2) { ?>
						<p style="color:<?= ($this->s->goldStolen > 0 ? 'green' : 'red') ?>"><?= numecho($this->s->goldStolen) ?> Gold</p>
					<?php }
						else { ?>
						<p style="color:<?= ($this->s->weaponamount > 0 ? 'green' : 'red') ?>">
						<?php
						numecho($this->s->weaponamount); echo ' ';
						$w = new Weapon();
						$w->weaponId = $this->s->weapontype2;
						$w->isAttack = $this->s->weapontype;
						echo $w->getName(); 
						?></p>
					<?php } ?>
					<p>While on this mission, the <?= $pngt ?> had to take 
						<span style="color:<?= ($this->s->hostages > 0 ? 'green' : 'red') ?>"><?php numecho($this->s->hostages) ?></span>
						<?= ngt('hostage', 'hostages', $this->s->hostages) ?>
					</p>

				</div> 
			<?php } ?>
		<?php } ?>
	</div>
</div>
<!-- End Spy log page -->
