
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
<!-- Begin Stats page -->

<?php
$tag = '';
if ($this->target->alliance) {
	$tag = '&nbsp;' . $this->target->getAlliance()->getTag();
}
?>

<div id="statspage-container">

	<div class="panel">
		<div class="panel-title">
			<?= $this->target->username ?>'s Details
		</div>
		<table class="tab-stats table-details table-profile">
		<tr>
			<td class="title">Username</td>
			<td class="amount"><?= $this->target->getNameRecruit() . $tag ?></td>
		</tr>
		<?php if (Privacy::isAdmin()): ?>
			<tr>
				<td class="title">Admin Tools</td>
				<td class="amount">
					<a href="admin-stats.php?uid=<?= $this->target->id ?>">Stats</a>
					(<?= $this->target->currentIP ?>)
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<td class="title">Rank</td>
			<td class="amount"><?= numecho($this->target->rank) ?></td>
		</tr>
		<tr>
			<td class="title">Nation</td>
			<td class="amount">
				<div class="flag-top"><?= $this->target->getNationName() ?></div>
				<img class="flag-med" style="margin-bottom: 5px !important;" title="<?= $this->target->getNationName() ?>" alt="<?= $this->target->getNationName() ?>" src="<?= $this->image($this->target->getNationFlag()) ?>" />
			</td>
		</tr>
		<?php if (AREAS): ?>
		<tr>
			<td class="title">Area</td>
			<td class="amount"><?= $this->target->getAreaName() ?></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="title">Commander</td>
			<td class="amount">
				<?php if($this->target->commander) { ?>
					<?= $this->target->getCommander()->getNameLink() ?>
				<?php }
					else { ?>
					None
				<?php } ?>
			</td>
		</tr>
		<?php if (ALLIANCES): ?>
		<tr>
			<td class="title">Alliance</td>
			<td class="amount"><?= "none" ?></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="title">Army Size</td>
			<td class="amount"><?= numecho($this->target->getTFF()) ?></td>
		</tr>
		<tr>
			<td class="title gold">Gold</td>
			<td class="amount gold"><?= ( $user->canSpyOn($this->target) ? numecho2($this->target->gold) : '?????' ) ?></td>
		</tr>
		<?php if (SUPPORT): ?>
		<tr>
			<td class="title">Area</td>
			<td class="amount"><?= $this->target->getNameRecruit() . $tag ?></td>
		</tr>
		<?php endif; ?>
		</table>

		<?php if ($user->id && $this->target->id != $user->id): ?>
		<div class="panel-title">
			Actions towards <?= $this->target->username ?>
		</div>
		<table class="tab-stats table-details table-profile">
		<?php if (!AREAS || (AREAS && $this->target->area == $user->area)): ?>
		<tr>
			<td class="title">Attack</td>
			<td class="amount">
				<form action="attack.php" method="post" class="right-section">
					<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
					<input type="submit" name="mass" value="Pierce (1 Turn)" />&nbsp;&nbsp;|&nbsp;
					<input type="submit" name="raid" value="Strike (6 Turns)" />
				</form>
			</td>
		</tr>
		<tr>
			<td class="title">Spy</td>
			<td class="amount">
				<form action="spy.php" method="post" class="right-section">
					<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
					<input type="submit" name="spy" value="<?= numecho($conf['spying-cost']) ?> gold to Spy!" />
				</form>
			</td>
		</tr>
		<?php if (THIEVES): ?>
		<tr>
			<td class="title">Thieve</td>
			<td class="amount">
				<form action="theft.php" method="post" class="right-section">
					<input type="hidden" name="id" value="<?= $this->target->id ?>" />
			
					<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
					<?php if (!$user->getSupport('theft-calc')) { ?>
						<label for="spies">Spies:</label>
						<input id="theft-spies" type="text" name="spies" value="" style="margin-bottom:5px;"/>
						<br />
					<?php } ?>
					<input type="submit" name="saweapons" value="Attack Weapons" /> |
					<input type="submit" name="daweapons" value="Defense Weapons" /> |
					<?php if ($user->nation != 1 and $user->nation != 3) { ?>
						<input type="submit" name="gold" value="Gold" />
					<?php } ?>
				</form>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="title">Message</td>
			<td class="amount">
				<form action="writemail.php" method="post" class="right-section">
					<input type="hidden" name="to[]" value="<?= $this->target->id ?>" />
					<input type="submit" name="message" value="Send a Message!" />
				</form>
			</td>
		</tr>
		<tr>
			<td class="title">Join</td>
			<td class="amount">
				<?php if ($this->target->numofficers < $this->target->maxofficers) { ?>
					<?php if ($user->commander != $this->target->id) { ?>
						<form method="post" class="right-section">
							<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
							<input type="submit" name="mkcommander" value="Make this user my commander!" />
						</form>
					<?php }
						else { ?>
						<span>[ This is your commander ]</span>
					<?php } ?>
				<?php }
					else { ?>
					<span>[ This user has enough officers ]</span>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td class="title">Report</td>
			<td class="amount">
				<a href="report-user.php?uid=<?= $this->target->id ?>">Report User</a>
			</td>
		</tr>
		<?php endif; ?>
		<?php endif; ?>
		</table>


		<?php if (false): ?>
		<!-- <div class="large">
			<div class="line">
				<label>Username</label>
				<span><?= $this->target->getNameRecruit() . $tag ?></span>
			</div>
			<?php if (Privacy::isAdmin()) { ?>
				<div class="line">
					<span>
						<a href="admin-stats.php?uid=<?= $this->target->id ?>">Stats</a>
						(<?= $this->target->currentIP ?>)
					</span>
				</div>
			<?php } ?>
			<?php if (SUPPORT) { ?>
			<div class="line">
				<span colspan="2" style="text-align:center;margin-left:0;">
					<a href="support.php?uid=<?= $this->target->id ?>" title="Buy Supporter Status for <?= $this->target->getNameHTML() ?>">
						Buy <?= $this->target->getNameHTML() ?> Supporter Status
					</a>
				</span>
			</div>
			<?php } ?>
			<div class="line">
				<label>Commander</label>
				<span>
					<?php if($this->target->commander) { ?>
						<?= $this->target->getCommander()->getNameLink() ?>
					<?php }
						else { ?>
						None
					<?php } ?>
				</span>
			</div>
			<div class="line">
				<label>Nation</label>
				<img class="flag-med" title="<?= $this->target->getNation() ?>" alt="<?= $this->target->getNation() ?>" src="<?= $this->image($this->target->getNationFlag()) ?>" />
				<div class="flag-label"><?= $this->target->getNation() ?></div>
			</div>
			<div class="line">
				<label>Area</label>
				<span><?= $this->target->getAreaName() ?></span>
			</div>
			<div class="line">
				<label>Rank</label>
				<span><?= numecho($this->target->rank) ?></span>
			</div>
			<div class="line">
				<label>Army Size</label>
				<span><?= numecho($this->target->getTFF()) ?></span>
			</div>
			<div class="line gold">
				<label>Gold</label>
				<span><?= ( $user->canSpyOn($this->target) ? numecho2($this->target->gold) : '?????' ) ?></span>
			</div>
			<?php if ($user->id) { ?>
				<?php if ($this->target->id != $user->id) { ?>
					<?php if ($this->target->area == $user->area/* and IP::canAttack($user, $this->target)*/) { ?>
						<div class="line">
							<label>Spy</label>
							<form action="spy.php" method="post" class="right-section">
								<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
								<input type="submit" name="spy" value="<?= numecho($conf['spying-cost']) ?> gold to Spy!" />
							</form>
						</div>
						<div class="line">
							<label>Thieve</label>
							<form action="theft.php" method="post" class="right-section">
								<input type="hidden" name="id" value="<?= $this->target->id ?>" />
						
								<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
								<?php if (!$user->getSupport('theft-calc')) { ?>
									<label for="spies">Spies:</label>
									<input id="theft-spies" type="text" name="spies" value="" style="margin-bottom:5px;"/>
									<br />
								<?php } ?>
								<input type="submit" name="saweapons" value="Attack Weapons" /> |
								<input type="submit" name="daweapons" value="Defense Weapons" /> |
								<?php if ($user->nation != 1 and $user->nation != 3) { ?>
									<input type="submit" name="gold" value="Gold" />
								<?php } ?>
							</form>
						</div>
						<div class="line">
							<label>Attack</label>
							<form action="attack.php" method="post" class="right-section">
								<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
								<input type="submit" name="mass" value="1 Turn Mass!" />&nbsp;&nbsp;|&nbsp;
								<input type="submit" name="raid" value="6 Turn Raid!" />
							</form>
						</div>
					<?php } ?>
					<div class="line">
						<label>&nbsp;</label>
						<form action="writemail.php" method="post" class="right-section">
							<input type="hidden" name="to[]" value="<?= $this->target->id ?>" />
							<input type="submit" name="message" value="Send a Message!" />
						</form>
					</div>
				<?php } ?>

				<div class="line">
					<label>&nbsp;</label>
					<?php if ($this->target->numofficers < $this->target->maxofficers) { ?>
						<?php if ($user->commander != $this->target->id) { ?>
							<form method="post" class="right-section">
								<input type="hidden" name="uid" value="<?= $this->target->id ?>" />
								<input type="submit" name="mkcommander" value="Make this user my commander!" />
							</form>
						<?php }
							else { ?>
							<span>[ This is your commander ]</span>
						<?php } ?>
					<?php }
						else { ?>
						<span>[ This user has enough officers ]</span>
					<?php } ?>
				</div>
				
			<?php } ?>
			<div class="clear flat"></div>
		</div> -->
		<?php endif; ?>
	</div>

	<?php
		$tmp = $user;
		$this->offargs = 'uid=' . $this->target->id;
		$this->user = $this->target;
		$this->load('officers-list');
		$this->user = $tmp;
	?>

</div>
<!-- End Stats Page -->
