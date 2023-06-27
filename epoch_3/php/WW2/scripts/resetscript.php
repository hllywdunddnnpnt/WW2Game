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


/** Changelog
29th May, 10   Update for age 18
24th Apr, 10   Update for age 17
---- Mar, 10
26th Feb, 10   Update for age 15 added area stuff to hof
26th Dec, 09   Update for age 14
28th Nov, 09   Update for age 13
1st  Nov, 09.  Update for age 12
28th Sept, 09. Update for age 11
30th Aug, 09.  Update for age 10
26th July, 09. Update for age 9 or eight...
28th June, 09. Ran for age 7. User.sflevel -> User.ralevel
24th June, 09 - click -> Recruit, hof.race -> hof.nation
23rd June, 09 (pre age 8, initial)
 
*/


/*

// move top 30 up from area 2->1
update User set area=4 where area=2 and rank <=30 and  rank >=1 and active=1;
// move top 60 up from area 2->2
update User set area=5 where area=3 and rank <= 60 and rank >= 1 and active=1;
//move bottom 60 down from area 2->3
update User set area=6 where area=2 and rank >= 181 and rank <= 240 and active=1;
update User set area=1 where area=4;
update User set area=2 where area=5;
update User set area=3 where area=6;
*/

// First, tell all the scripts that we're running without HTML
$incron = true;
// Include everything we need
//require_once('vsys.php');
require_once('cron.php');

$db_hof = select_db("ww3game_hof");
$db_backups = select_db("ww3game_backups");

$hof = $_AGE;
$table_name_hof = "hof_$hof";

$mode_submit = true;
$mode_reset = false;

/*
function report($message, $area=null)
	{
		global $reports;
		$reports[ isset($area) ? $area : "default" ][] = $message;
		echo $message;
	}

function query_submit($db, $query, $area)
	{
		global $reports;
		$reports[ isset($area) ? $area : "default" ][] = $message;
		echo $message;
	}*/

$reports = [ "default" => [] ];


if ($mode_submit):


//die("MAKE SURE THE AGE IS CORRECT");
/*
	Stage 1 : Back up the tables
*/
// A list of tables that we'll use, so need to back up
$tableList = array(
	'battlelog',
	'spylog',
	'user',
	'weapon'
);

for ($i = 0; $i < count($tableList); $i++) {
//foreach ($tableList as $i => $tabitem) {
	$tabitem = $tableList[$i];
	// Copy the tables
	$tabitem_hof = $tabitem."_".$hof;
	echo "resetscript: dropping $tabitem_hof if exists<br>";
	mysqli_query($db_backups, "drop table if exists $tabitem_hof");
	echo "resetscript: backing up table $table as $tabitem_hof<br>";
	$q = mysqli_query($db_backups, "CREATE TABLE IF NOT EXISTS $tabitem_hof SELECT * FROM $dbname.$tabitem");
	if (!$q)
		{
			$str_error = "Table '.\ww3game_db\\$table' is marked as crashed and should be repaired";
			echo mysqli_error($db_backups);
			if (mysqli_error($db_backups) == $str_error)
				{
					mysqli_query($db, "REPAIR TABLE $table") or die("1.2:".mysqli_error($db));
					echo "$table repaired!";
					$i--;
				}
			else
				{
					die("1.1:".mysqli_error($db_backups));
				}
		} 
}

// TODO: update for table column names.

$hofTable = "CREATE TABLE IF NOT EXISTS `$table_name_hof` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL DEFAULT 0,
	`username` varchar(25) NOT NULL,
	`nation` tinyint(4) NOT NULL default '0',
	`email` varchar(100) NOT NULL,
	`gclick` tinyint(2) NOT NULL default '15',
	`commander` int(10) NOT NULL default '0',
	`active` int(1) NOT NULL default '0',
	`area` int(11) NOT NULL default '0',
	`dalevel` int(10) NOT NULL default '0',
	`salevel` int(10) NOT NULL default '0',
	`gold` bigint(15) NOT NULL default '0',
	`bank` bigint(10) unsigned NOT NULL default '0',
	`primary` tinyint(1) NOT NULL default '0',
	`attackturns` bigint(15) NOT NULL default '0',
	`up` bigint(15) unsigned NOT NULL default '0',
	`calevel` int(10) unsigned NOT NULL default '0',
	`ralevel` int(10) unsigned NOT NULL default '0',
	`maxofficers` smallint(2) NOT NULL default '5',
	`sasoldiers` bigint(15) NOT NULL default '0',
	`samercs` bigint(15) NOT NULL default '0',
	`dasoldiers` bigint(15) NOT NULL default '0',
	`damercs` bigint(15) NOT NULL default '0',
	`uu` bigint(15) unsigned NOT NULL default '0',
	`spies` bigint(15) unsigned NOT NULL default '0',
	`accepted` tinyint(1) NOT NULL default '0',
	`commandergold` bigint(15) NOT NULL default '0',
	`gameSkill` int(10) NOT NULL default '0',
	`specialforces` bigint(15) unsigned NOT NULL default '0',
	`bankper` int(10) NOT NULL default '10',
	`SA` bigint(15) unsigned NOT NULL default '0',
	`DA` bigint(15) unsigned NOT NULL default '0',
	`CA` bigint(15) unsigned NOT NULL default '0',
	`RA` bigint(15) unsigned NOT NULL default '0',
	`rank` int(10) NOT NULL default '0',
	`sarank` int(10) NOT NULL default '0',
	`darank` int(10) NOT NULL default '0',
	`carank` int(10) NOT NULL default '0',
	`rarank` int(10) NOT NULL default '0',
	`alliance` int(5) NOT NULL default '0',
	`hhlevel` int(10) NOT NULL default '0',
	`officerup` float NOT NULL default '0',
	`changenick` tinyint(4) NOT NULL default '0',
	`admin` int(10) NOT NULL default '0',
	`clicks` int(10) NOT NULL default '0',
	`clickall` tinyint(1) NOT NULL default '0',
	`cheatcount` int(10) NOT NULL default '0',
	`status` varchar(50) NOT NULL default '',
	`numofficers` int(10) NOT NULL default '0',
	`aaccepted` tinyint(1) NOT NULL default '0',
	`minattack` bigint(15) NOT NULL default '0',
	`goldwon` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`goldlost` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`battleswon` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battleslost` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battlesdefended` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battlesuuwon` BIGINT(15) NOT NULL DEFAULT 0,
	`battlesuulost` BIGINT(15) NOT NULL DEFAULT 0,
	`theftscore` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`theftuu` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`theftgold` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`income` INT( 11 ) NOT NULL  DEFAULT 0,
	PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;";
/*
// create the new HOF table
$hofTable = "CREATE TABLE IF NOT EXISTS `$table_name_hof` (
	`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
	`uid` INT(11) NOT NULL DEFAULT 0,
	`area` TINYINT(2) NOT NULL DEFAULT 2,
	`username` VARCHAR( 50 ) NOT NULL ,
	`alliance` VARCHAR( 50 )  DEFAULT 0,
	`nation` SMALLINT( 1 ) NOT NULL  DEFAULT 0,
	`bankper` TINYINT( 3 ) NOT NULL  DEFAULT 0,
	`officerup` INT( 11 ) NOT NULL  DEFAULT 0,
	`untrained` INT( 11 ) NOT NULL  DEFAULT 0,
	`trainedsa` INT( 11 ) NOT NULL  DEFAULT 0,
	`trainedda` INT( 11 ) NOT NULL  DEFAULT 0,
	`samerc` INT( 11 ) NOT NULL  DEFAULT 0,
	`damerc` INT( 11 ) NOT NULL  DEFAULT 0,
	`spies` INT( 11 ) NOT NULL  DEFAULT 0,
	`sf` INT( 11 ) NOT NULL  DEFAULT 0,
	`raupgrade` INT( 3 ) NOT NULL  DEFAULT 0,
	`saupgrade` INT( 3 ) NOT NULL  DEFAULT 0,
	`daupgrade` INT( 3 ) NOT NULL  DEFAULT 0,
	`caupgrade` INT( 3 ) NOT NULL  DEFAULT 0,
	`sa` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`da` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`ca` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`ra` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`sarank` INT( 11 ) NOT NULL  DEFAULT 0,
	`darank` INT( 11 ) NOT NULL  DEFAULT 0,
	`carank` INT( 11 ) NOT NULL  DEFAULT 0,
	`rarank` INT( 11 ) NOT NULL  DEFAULT 0,
	`goldwon` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`goldlost` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`battleswon` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battleslost` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battlesdefended` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`battlesuuwon` BIGINT(15) NOT NULL DEFAULT 0,
	`battlesuulost` BIGINT(15) NOT NULL DEFAULT 0,
	`theftscore` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`theftuu` BIGINT( 15 ) NOT NULL  DEFAULT 0,
	`theftgold` BIGINT( 21 ) NOT NULL  DEFAULT 0,
	`up` INT( 11 ) NOT NULL  DEFAULT 0,
	`income` INT( 11 ) NOT NULL  DEFAULT 0,
	`numofficers` INT( 11 ) NOT NULL  DEFAULT 0,
	PRIMARY KEY ( `ID` ),
	UNIQUE (
	`username`
	)
) ENGINE = MYISAM ;";
*/	


mysqli_query($db_hof, $hofTable) or die("2:".mysqli_error($db_hof));
mysqli_query($db_hof, "truncate $table_name_hof") or die("3:".mysqli_error($db_hof));



echo "resetscript: inserting primary values into $table_name_hof\n";
// insert the basic values
$hofq = mysqli_query($db_hof, "
	INSERT INTO
	$table_name_hof
	(
		`uid`,
		`username`,
		`nation`,
		`email`,
		`gclick`,
		`commander`,
		`active`,
		`area`,
		`dalevel`,
		`salevel`,
		`gold`,
		`bank`,
		`primary`,
		`attackturns`,
		`up`,
		`calevel`,
		`ralevel`,
		`maxofficers`,
		`sasoldiers`,
		`samercs`,
		`dasoldiers`,
		`damercs`,
		`uu`,
		`spies`,
		`accepted`,
		`commandergold`,
		`gameSkill`,
		`specialforces`,
		`bankper`,
		`SA`,
		`DA`,
		`CA`,
		`RA`,
		`rank`,
		`sarank`,
		`darank`,
		`carank`,
		`rarank`,
		`alliance`,
		`hhlevel`,
		`officerup`,
		`admin`,
		`clicks`,
		`clickall`,
		`cheatcount`,
		`status`,
		`numofficers`,
		`aaccepted`,
		`minattack`
	)
	SELECT
		`id`,
		`username`,
		`nation`,
		`email`,
		`gclick`,
		`commander`,
		`active`,
		`area`,
		`dalevel`,
		`salevel`,
		`gold`,
		`bank`,
		`primary`,
		`attackturns`,
		`up`,
		`calevel`,
		`ralevel`,
		`maxofficers`,
		`sasoldiers`,
		`samercs`,
		`dasoldiers`,
		`damercs`,
		`uu`,
		`spies`,
		`accepted`,
		`commandergold`,
		`gameSkill`,
		`specialforces`,
		`bankper`,
		`SA`,
		`DA`,
		`CA`,
		`RA`,
		`rank`,
		`sarank`,
		`darank`,
		`carank`,
		`rarank`,
		`alliance`,
		`hhlevel`,
		`officerup`,
		`admin`,
		`clicks`,
		`clickall`,
		`cheatcount`,
		`status`,
		`numofficers`,
		`aaccepted`,
		`minattack`
	FROM
		$dbname.User
	WHERE
		$dbname.User.active = 1;
") or die("4:".mysqli_error($db_hof));

$users = User::getActiveUsers(false, false);

echo "<br>";

$nusers = count($users);
$i = 0;
foreach($users as $user) {
	echo "resetscript: (" . round(($i / $nusers)*100, 2) . "%) calculating user ($user->id:$user->username)<br>";
	$i++;
	$ret = (Object) [];
	
	$q = mysqli_query($db, "select sum(goldStolen) as retCode from BattleLog where attackerId = $user->id") or die("5.1:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->goldTaken = (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(goldStolen) as retCode from BattleLog where targetId = $user->id") or die("5.2:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->goldLost = (float)$a->retCode;
	
	$q = mysqli_query($db, "select count(*) as retCode from BattleLog where isSuccess = 1 and attackerId = $user->id") or die("5.3:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->battlesWon = (float)$a->retCode;
	
	$q = mysqli_query($db, "select count(*) as retCode from BattleLog where isSuccess = 1 and targetId = $user->id") or die("5.4:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->battlesDefended = (float)$a->retCode;
	
	$q = mysqli_query($db, "select count(*) as retCode from BattleLog where isSuccess = 0 and attackerId = $user->id") or die("5.5:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->battlesLost = (float)$a->retCode;
	
	$q = mysqli_query($db, "select count(*) as retCode from BattleLog where isSuccess = 0 and targetId = $user->id") or die("5.6:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->battlesNotDefended = (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(attackerHostages) as retCode from BattleLog where attackerId = $user->id") or die("5.7:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->powTaken = (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(targetHostages) as retCode from BattleLog where targetId = $user->id") or die("5.8:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->powTaken += (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(attackerHostages) as retCode from BattleLog where  targetId = $user->id") or die("5.9:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->powLost = (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(targetHostages) as retCode from BattleLog where attackerId = $user->id") or die("5.10:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->powLost += (float)$a->retCode;
	
	
	$ret->income = $user->getIncome();
	
	$ret->theftScore = 0;
	$q = mysqli_query($db, "select * from SpyLog where type=1 and attackerId = $user->id and isSuccess = 1 and weaponamount > 0") or die("5.11:".mysqli_error($db));
	while ($r = mysqli_fetch_object($q)) {
		$ret->theftScore += ($r->weaponamount * $conf['weapon' . $r->weapontype2 . 'strength']);
	}
	
	$q = mysqli_query($db, "select sum(goldStolen) as retCode from SpyLog where type=2 and attackerId = $user->id") or die("5.12:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->theftGold = (float)$a->retCode;
	
	$q = mysqli_query($db, "select sum(hostages) as retCode from SpyLog where type > 0 and attackerId = $user->id") or die("5.13:".mysqli_error($db));
	$a = mysqli_fetch_object($q);
	$ret->theftUU = (float)$a->retCode;
	
	$sql = "
		UPDATE `$table_name_hof`
		SET
			`goldwon`         = '$ret->goldTaken',
			`goldlost`        = '$ret->goldLost',
			`battleswon`     = '$ret->battlesWon',
			`battleslost`     = '$ret->battlesLost',
			`battlesdefended` = '$ret->battlesDefended',
			`battlesuuwon`    = '$ret->powTaken',
			`battlesuulost`   = '$ret->powLost',
			`theftscore`      = '$ret->theftScore',
			`theftuu`         = '$ret->theftUU',
			`theftgold`      = '$ret->theftGold',
			`income`          = '$ret->income'
		WHERE
			`uid` = '$user->id'
	";
	mysqli_query($db_hof, $sql) or die("6:".mysqli_error($db_hof)."<BR>".$sql);
}

endif;

if ($mode_reset):

// Tables to Truncate
$clean = array(
	'BattleLog',
	//'Recruit',
	'SpyLog',
	'Weapon',
);
echo "done";

foreach ($clean as $tbl) {
	echo "resetscript: truncating table $tbl\n";
	$sql = "TRUNCATE $tbl";
	mysqli_query($db, $sql) or die("7:".mysqli_error($db));
}

// Now reset the Mercenaries table
$sql = "
update 
	Mercenaries 
set
	attackspeccount = 0,
	defspeccount    = 0,
	untrainedcount  = 0;
";
mysqli_query($db, $sql) or die("8:".mysqli_error($db));

echo "resetscript: resetting User\n";
// reset User
$sql = "
update
	User
set
	gclick        = 15,
	dalevel       = 0,
	salevel       = 0,
	gold          = {$conf['start-gold']},
	bank          = 0,
	attackturns   = {$conf['start-attackturns']},
	up            = 0,
	calevel       = 0,
	ralevel       = 0,
	sasoldiers    = {$conf['start-sasoldiers']},
	samercs       = 0,
	dasoldiers    = {$conf['start-dasoldiers']},
	damercs       = 0,
	uu            = {$conf['start-uu']},
	spies         = 0,
	commandergold = 0,
	gameSkill     = gameSkill + 3000,
	specialforces = 0,
	SA            = 0,
	DA            = 0,
	CA            = 0,
	RA            = 0,
	hhlevel       = 0,
	officerup     = 0,
	changenick    = 0,
	clicks        = 0,
	clickall      = 0,
	bankimg       = 0	
";
mysqli_query($db, $sql) or die("9:".mysqli_error($db));

endif;

?>
