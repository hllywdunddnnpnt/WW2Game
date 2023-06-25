
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
<!-- Begin Training page -->
<div id="training-container">
	<form method="post">
		<h1 class="">
			Training
		</h1>
		<div class="boxer ">
			Untrained Soldiers: <span class="high"><b><?= numecho($user->uu) ?></b></span>
		</div>
		<div id="training-form" class="panel">
			<div class="panel-title">
				Train Troops
			</div>
			<table>
				<tr>
					<th width="30%" style="text-align: right;">Training Program</th>
					<th width="15%" style="text-align: center;">Current</th>
					<th width="15%" style="text-align: center;">Cost Per Unit</th>
					<th width="25%" style="text-align: center;">Quantity</th>
					<th width="15%" style="text-align: center;">&nbsp;</th>
				</tr>
				<tr>
					<td style="text-align: right;">Attack Specialist</td>
					<td style="text-align: center;"><?= numecho($user->sasoldiers) ?></td>
					<td style="text-align: center;"><?= numecho($conf['cost']['sasoldier']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-sasoldiers" name="train-sasoldiers" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return trainMax('sasoldiers', <?= $conf['cost']['sasoldier'] ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Defense Specialist</td>
					<td style="text-align: center;"><?= numecho($user->dasoldiers) ?></td>
					<td style="text-align: center;"><?= numecho($conf['cost']['dasoldier']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-dasoldiers" name="train-dasoldiers" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return trainMax('dasoldiers', <?= $conf['cost']['dasoldier'] ?>)" value="Max" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Spy</td>
					<td style="text-align: center;"><?= numecho($user->spies) ?></td>
					<td style="text-align: center;"><?= numecho($conf['cost']['spy']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-spies" name="train-spies" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return trainMax('spies', <?= $conf['cost']['spy'] ?>)" value="Max" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Specialist Forces Operative</td>
					<td style="text-align: center;"><?= numecho($user->specialforces) ?></td>
					<td style="text-align: center;"><?= numecho($conf['cost']['specialforces']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-specialforces" name="train-specialforces" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return trainMax('specialforces', <?= $conf['cost']['specialforces'] ?>)" value="Max" value="Max" style="width: 60px;" /></td>
				</tr>
			</table>
		</div>
		
		<div id="merc-form" class="panel">
			<div class="panel-title">
				Hire Mercenaries
			</div>
			<table>
				<tr>
					<th width="30%" style="text-align: right;">Mercenary</th>
					<th width="15%" style="text-align: center;">Current</th>
					<th width="15%" style="text-align: center;">Cost Per Unit</th>
					<th width="25%" style="text-align: center;">Quantity</th>
					<th width="15%" style="text-align: center;">Available</th>
				</tr>
				<tr>
					<td style="text-align: right;">Attack Specialist</td>
					<td style="text-align: center;"><?= numecho($user->samercs) ?></td>
					<td style="text-align: left;"><?= numecho($conf['cost']['samerc']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-samerc" name="train-samerc" value="0" /></td>
					<td style="text-align: center;"><?= numecho($this->merc->samercs) ?></td>
				</tr>
				<tr>
					<td style="text-align: right;">Defense Specialist</td>
					<td style="text-align: center;"><?= numecho($user->damercs) ?></td>
					<td style="text-align: left;"><?= numecho($conf['cost']['damerc']) ?></td>
					<td style="text-align: center;"><input type="text" id="train-damerc" name="train-damerc" value="0" /></td>
					<td style="text-align: center;"><?= numecho($this->merc->damercs) ?></td>
				</tr>
				<!-- <tr>
					<td colspan="4">&nbsp;</td>
					<td style="text-align:right;padding-right: 10px;"><input type="submit" name="train-train" value="Train" /></td>
				</tr> -->
			</table>
		</div>
		<div class="form-sub-bottom">
			<input type="submit" class="btn-sub" name="train-train" value="Train" />
		</div>
	</form>

	<form method="post">
		<h1 class="" style="margin-top: 30px;">
			Reassigning
		</h1>
		<div id="untraining-form" class="panel">
			<div class="panel-title">
				Reassign Troops
			</div>
			<table>
				<tr>
					<th width="30%" style="text-align: right;">Soldier Type</th>
					<th width="30%" style="text-align: center;">Current</th>
					<th width="25%" style="text-align: center;">Quantity</th>
					<th width="15%" style="text-align: center;">&nbsp;</th>
				</tr>
				<tr>
					<td style="text-align: right;">Attack Specialist</td>
					<td style="text-align: center;"><?= numecho($user->sasoldiers) ?></td>
					<td style="text-align: center;"><input type="text" id="untrain-sasoldiers" name="untrain-sasoldiers" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('sasoldiers', <?= $user->sasoldiers ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Defense Specialist</td>
					<td style="text-align: center;"><?= numecho($user->dasoldiers) ?></td>
					<td style="text-align: center;"><input type="text" id="untrain-dasoldiers" name="untrain-dasoldiers" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('dasoldiers', <?= $user->dasoldiers ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Spy</td>
					<td style="text-align: center;"><?= numecho($user->spies) ?></td>
					<td style="text-align: center;"><input type="text" id="untrain-spies" name="untrain-spies" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('spies', <?= $user->spies ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Specialist Forces Operative</td>
					<td style="text-align: center;"><?= numecho($user->specialforces) ?></td>
					<td style="text-align: center;"><input type="text" id="untrain-specialforces" name="untrain-specialforces" value="0" /></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('specialforces', <?= $user->specialforces ?>)" value="Max" style="width: 60px;" /></td>
				</tr>

<!--
	Removed because of links
				<tr>
					<td style="text-align: right;">Attack Mercenary</td>
					<td style="text-align: center;"><?= numecho($user->samercs) ?></td>
					<td style="text-align: center;"><input style="width:50%;" type="text" id="untrain-samercs" name="untrain-samercs" value="0" /> for <?= numecho($conf['cost']['sasoldier'] * 0.5) ?></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('samercs', <?= $user->samercs ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right;">Defense Mercenary</td>
					<td style="text-align: center;"><?= numecho($user->damercs) ?></td>
					<td style="text-align: center;"><input style="width:50%;" type="text" id="untrain-damercs" name="untrain-damercs" value="0" /> for <?= numecho($conf['cost']['sasoldier'] * 0.5) ?></td>
					<td style="text-align: left;"><input type="button" onclick="javascript:return untrainMax('damercs', <?= $user->damercs ?>)" value="Max" style="width: 60px;" /></td>
				</tr>
-->
				<!-- <tr>
					<td colspan="3">&nbsp;</td>
					<td><input type="submit" name="train-untrain" value="Reassign" /></td>
				</tr> -->
				
			</table>
		</div>
		<div class="form-sub-bottom">
			<input type="submit" class="btn-sub" name="train-untrain" value="Reassign" />
		</div>

	</form>
	
</div>
<!-- End Training page -->
