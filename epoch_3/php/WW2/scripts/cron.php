<?php
/***

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

***/

if (!isset($PATH)) $PATH = dirname(__FILE__)."/../";

$incron = true;
//ini_set('include_path', '.:/home/ww2game/public_html/scripts/:/home/ww2game/public_html/');

include('vsys.php');
require_once('Message.php');
$errcount = 0;

$time = time();


//Updates the Ranks.active
$b=mysqli_query($db, 'UPDATE `User` SET `rank`=0, `sarank`=0, `darank`=0, `carank`=0, `rarank`=0 WHERE `active`!=1') or die("e1".mysqli_error($db));



mysqli_query($db, 'UPDATE User u1, User u2 SET u2.commandergold=0, u2.commander=0 WHERE u2.commander=u1.id AND u1.active!=1') or die("e2".mysqli_error($db));



$avgsa   = 0;
$avgda   = 0; 
$avgca   = 0;
$avgra   = 0; 
$avgtbg  = 0; 
$avgarmy = 0; 
$avgup   = 0; 

$catchup = 1;

$d = floor((time() - $conf['last-turn']) / 900) - 1;

if ($d > 2){
    //$catchup = $d;
}



mysqli_query($db, "DELETE FROM Weapon WHERE weaponStrength <=0 or weaponCount <=0") or die("e3".mysqli_error($db));

if($allow_bonuses){
	mysqli_query($db, "UPDATE User u,Alliance a SET u.uu=u.uu+a.up WHERE u.alliance=a.id AND u.alliance>0 AND u.aaccepted>0") or die("e4".mysqli_error($db));
}

$users = User::getActiveUsers();
$c = count($users);

$alliances = array();


foreach ($users as $user) {
	// Update the user, and only the user.
	$income = $user->getIncome() * $catchup;

	// TODO: alliance tax;

	// Get his officers
	$q = mysqli_query($db, "SELECT count(*) as offCount, sum(sasoldiers+dasoldiers+uu) as unitCount from User WHERE commander = $user->id AND active=1 AND accepted=1") or die("e5".mysqli_error($db));
	$ret = mysqli_fetch_object($q);


	$user->clickall = 0;
	$user->bankimg = 1;
	if ($user->gclick == 0) {
		$user->gclick = 1;
	}

	$user->numofficers = $ret->offCount;
	$user->commandergold = floor($ret->unitCount * $conf['gps'][0] * 0.01);
	#$user->uu += $user->officerup + ($user->up * $catchup);
	$user->uu += ($user->up * $catchup);
	$income += $user->commandergold;
	$user->attackturns += 2 * $catchup;
	if ($user->attackturns > $conf['attackturn-cap']) {
		$user->attackturns = $conf['attackturn-cap'];
	}
	if ($catchup > 4) {
		$user->bank += $income;
	}
	else {
		$user->gold += $income;
	}

	if ($user->commander) {
		// get his up
		// XXX todo, make sure he's active.
		$up = floor($user->getCommander()->up * 0.03);
		$user->officerup = $up;
		$user->uu       += $up;
	}

	$avgtbg += $income / $c;  //add to counter
	$avgarmy += $user->getTFF() / $c; //Army size
	$avgup += $user->up / $c;  //UP

	$user->unreadMsg = Message::getNewCount($user->id);
	$user->msgCount  = Message::getCount($user->id);

	$user->cacheStats();

}


$avgsql="SELECT floor(sum(sa)/count(*)) as avgsa, floor(sum(da)/count(*)) as avgda, floor(sum(ca)/count(*)) as avgca, floor(sum(ra)/count(*)) as avgra FROM User where active=1";

$avq=mysqli_query($db, $avgsql) or die("e6".mysqli_error($db));
$avr=mysqli_fetch_array($avq,MYSQLI_ASSOC);
$avgsa=0;
$avgda=0;
$avgca=0;
$avgra =0;


$avghit=0;
$t=time()-(60*60*24);
$q=mysqli_query($db, "SELECT (SUM(goldStolen)/count(*)) as avghit FROM BattleLog WHERE goldStolen>0 AND time>$t") or die("e7".mysqli_error($db));
$aha=mysqli_fetch_object($q);
$avghit= $aha ? intval($aha->avghit) : 0;

$avgarmy=floor($avgarmy);
$avgsa=$avr['avgsa'];
$avgda=$avr['avgda'];
$avgca=$avr['avgca'];
$avgra=$avr['avgra'];
$avgtbg=floor($avgtbg);
$avgup=floor($avgup);
$UpdateSQL="UPDATE Mercenaries ";
$UpdateSQL.=" SET attackSpecCount=attackSpecCount+'{$conf['mercenaries_per_turn']}', defSpecCount =defSpecCount +'{$conf['mercenaries_per_turn']}',  ";
$UpdateSQL.=" lastturntime='".time()."', ";
$UpdateSQL.=" avgarmy='$avgarmy',avghit='$avghit',avgtbg='$avgtbg',avgup='$avgup',avgsa='$avgsa',avgda='$avgda',avgca='$avgca', ";
$UpdateSQL.=" avgra='$avgra';";
mysqli_query($db, $UpdateSQL)or die("M".mysqli_error($db));


$q=mysqli_query($db, "SELECT id,area FROM User WHERE active=1 ORDER BY area,SA DESC")or die("e8".mysqli_error($db));
$i=1;
$area = 0;

while($row=mysqli_fetch_array($q, MYSQLI_ASSOC)) {
	if ($area != $row['area']) {
		$i = 1;
	}

	$update = mysqli_query($db, "UPDATE User SET sarank=$i WHERE id=".$row['id'])or die("e9".mysqli_error($db));
	$i++;
	$area = $row['area'];
}

$q=mysqli_query($db, "SELECT id,area FROM User WHERE active=1 ORDER BY area,DA DESC")or die("e20".mysqli_error($db));
$i=1;
$area = 0;
while($row=mysqli_fetch_array($q, MYSQLI_ASSOC)){
	if ($area != $row['area']) {
		$i = 1;
	}
	$update=mysqli_query($db, "UPDATE User SET darank=$i WHERE id=".$row['id'])or die("e21".mysqli_error($db));
	$i++;
	$area = $row['area'];
}

$q=mysqli_query($db, "SELECT id,area FROM User WHERE active=1 ORDER BY area,CA DESC")or die("e22".mysqli_error($db));
$i=1;
$area = 0;
while($row=mysqli_fetch_array($q,MYSQLI_ASSOC)){
	if ($area != $row['area']) {
		$i = 1;
	}
	$update=mysqli_query($db, "UPDATE User SET carank=$i WHERE id=".$row['id'])or die("e23".mysqli_error($db));
	$i++;
	$area = $row['area'];

}

$q=mysqli_query($db, "SELECT id,active,area FROM User WHERE active=1 ORDER BY area,RA DESC")or die("e24".mysqli_error($db));
$i=1;
$area = 0;
while($row=mysqli_fetch_array($q,MYSQLI_ASSOC)){
	if ($area != $row['area']) {
		$i = 1;
	}
	$update=mysqli_query($db, "UPDATE User SET rarank=$i,active=".$row['active']." WHERE id=".$row['id'])or die("e25".mysqli_error($db));
	$i++;
	$area = $row['area'];

}

$q=mysqli_query($db, "SELECT ((sarank+darank+carank+rarank)/4) as avgx, id, area FROM User WHERE active=1 ORDER BY area, avgx")or die("e10".mysqli_error($db));

$i = 1;
$area = 0;
while($row=mysqli_fetch_array($q,MYSQLI_ASSOC)){
	if ($area != $row['area']) {
		$i = 1;
	}

	$update=mysqli_query($db, "UPDATE `User` SET `rank`=$i WHERE `id`=".$row['id'])or die("e11".mysqli_error($db));
	$i++;
	$area = $row['area'];

}


//====== Alliance stuff ====

mysqli_query($db, "
				UPDATE Alliance a,User u 
				SET 
					a.leaderid3=0 
				WHERE a.leaderid3=u.id and u.active!=1
			") or die("e12".mysqli_error($db));

mysqli_query($db, "
				UPDATE Alliance a,User u 
				SET 
					a.leaderid2=a.leaderid3,
					a.leaderid3=0 
				WHERE a.leaderid2=u.id and u.active!=1
			") or die("e13".mysqli_error($db));

mysqli_query($db, "
				UPDATE Alliance a,User u 
				SET 
					a.leaderid1=a.leaderid2,
					a.leaderid2=a.leaderid3,
					a.leaderid3=0 
				WHERE a.leaderid1=u.id and u.active!=1
			") or die("e14".mysqli_error($db));

mysqli_query($db, "
UPDATE
	Alliance
SET
	status = 2
WHERE
	leaderid1 = 0 AND
	leaderid2 = 0 AND
	leaderid3 = 0
") or die("e15".mysqli_error($db));

$t = time();

$fp = fopen(DIRSCR.'gen-stats-l.php','w+') or die("e16".'Could not open file');
$str = "<?php \$conf['last-turn'] = " . $time . "; ?>";
fwrite($fp, $str);
fclose($fp);

?>
