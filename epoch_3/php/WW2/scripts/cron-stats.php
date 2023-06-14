<?php
$incron = true;
ini_set('include_path', '.:/home/ww2game/public_html/scripts/:/home/ww2game/public_html/');

include('vsys.php');


// Get the Stats for each area

// Europe
$stats['europe'] = array(
	'avgs' => getAvgStats(1),
	'hits' => getAvgHits(1),
);

// Africa
$stats['africa']= array(
	'avgs' => getAvgStats(2),
	'hits' => getAvgHits(2),
);

// Graveyard
$stats['graveyard']= array(
	'avgs' => getAvgStats(3),
	'hits' => getAvgHits(3),
);

$lastturn = time() - ($conf['minutes_per_turn'] * 60);

$q = mysqli_query($db, "SELECT count(*) as retCode FROM User where lastturntime > $lastturn") or die(mysqli_error($db));
$ret = mysqli_fetch_object($q);
$lastTurnActive = $ret->retCode;

$lastday= time() - (24 * 60 * 60);

$q = mysqli_query($db, "SELECT count(*) as retCode FROM User where lastturntime > $lastday") or die(mysqli_error($db));
$ret = mysqli_fetch_object($q);
$lastDayActive = $ret->retCode;

$q = mysqli_query($db, "SELECT count(*) as retCode FROM BattleLog where time > $lastday") or die(mysqli_error($db));
$ret = mysqli_fetch_object($q);
$totalAttacks = $ret->retCode;

$time = time();

$canChange = !$allow_bonuses ? 'true' : 'false';

$q = mysqli_query($db, "SELECT sum(gold) as g,(sum(bank)/count(*)) as b  FROM User") or die(mysqli_error($db));
$ret = mysqli_fetch_array($q, mysqli_ASSOC);

$totalGold = $ret['g'];
$avgBank   = $ret['b'];

$fp = fopen(INCDIR . '/scripts/gen-stats.php','w') or die('Could not open file');
$str = "<?php
\$conf['online-now'       ] = $lastTurnActive;
\$conf['online-today'     ] = $lastDayActive;
\$conf['attacks-today'    ] = $totalAttacks;
require_once(INCDIR . '/scripts/gen-stats-l.php');
\$conf['can-change-nation'] = $canChange;
\$conf['totalGold'        ] = $totalGold;
\$stats = " . var_export($stats, true ) . "
?>";

fwrite($fp,$str);
fclose($fp);

function getAvgHits($area) { global $db;
	$t = time() - (48 * 60 * 60); // in the last 48 hours
	$q = mysqli_query($db, "
		select 
			(sum(goldStolen)/count(*)) as hitAvg
		from BattleLog b inner join User u on b.attackerId = u.id
		where 
			u.lastturntime > $t and u.area = $area and
			b.isSuccess = 1
	") or die(mysqli_error($db));
	
	$ret['avghit'] = mysqli_fetch_array($q);
	
	$q = mysqli_query($db, "select attackerId, targetId, goldStolen from BattleLog b inner join User u on b.attackerId = u.id where u.area=$area and b.isSuccess=1 order by goldStolen DESC limit 0,10") or die(mysqli_error($db));

	$ret['top10'] = array();
		
	while ($r = mysqli_fetch_array($q)) {
		$ret['top10'][] = $r;
	}
	
	return $ret;
}

function getAvgStats($area) { global $db;
	$t = time() - (48 * 60 * 60); // in the last 48 hours
	$q = mysqli_query($db, "
		SELECT 
			(sum(SA)/count(*)) as saAvg,
			(sum(DA)/count(*)) as daAvg,
			(sum(CA)/count(*)) as caAvg,
			(sum(RA)/count(*)) as raAvg,
			(sum(UP)/count(*)) as upAvg,
			(sum(uu+spies+specialforces+samercs+sasoldiers+damercs+dasoldiers)/count(*)) as armyAvg,
			(sum(bank)/count(*)) as bankAvg,
			sum(gold) as totalGold
		FROM
			User
		WHERE
			active=1 AND area=$area AND lastturntime > $t
		") or die (mysqli_error($db));


	$a = mysqli_fetch_array($q);
	return $a;
}

?>
