<?php
$incron = true;
include ("vsys.php");
$errcount = 0;
$q = mysqli_query($db, "SELECT round((count(*)*38)/1048576) as mbytes FROM log_{$conf_ltable}") or die(mysqli_error($db));
$a = mysqli_fetch_object($q);
if ($a->mbytes >= 1024) {
	//we need to increment the logs
	if ($conf_ltable == 'A') {
		mysqli_query($db, 'TRUNCATE log_B');
		$nconf_ltable = 'B';
	}
	if ($conf_ltable == 'B') {
		mysqli_query($db, 'TRUNCATE log_C');
		$nconf_ltable = 'C';
	}
	if ($conf_ltable == 'C') {
		mysqli_query($db, 'TRUNCATE log_D');
		$nconf_ltable = 'D';
	}
	if ($conf_ltable == 'D') {
		mysqli_query($db, 'TRUNCATE log_E');
		$nconf_ltable = 'E';
	}
	if ($conf_ltable == 'E') {
		mysqli_query($db, 'TRUNCATE log_A');
		$nconf_ltable = 'A';
	}
	$fp = fopen('conf.php', 'w+');
	$file = fread($fp, filesize('conf.php'));
	$str = str_replace('$' . "conf_ltable = '$conf_ltable';", '$' . "conf_ltable = '$nconf_ltable';", $file);
	fwrite($fp, $str);
	$str = null;
	$file = null;
	fclose($fp);
}
echo "done logs<br>\n";
//Updates the Ranks.active
$rank_sql = "UPDATE Ranks,UserDetails SET Ranks.active=UserDetails.active WHERE UserDetails.ID=Ranks.userID";
$rank_sql_2 = "UPDATE Ranks SET rank=0,rankfloat=0,sarank=0,darank=0,carank=0,rarank=0 WHERE active!=1";
$a = mysqli_query($db, $rank_sql) or die(mysqli_error($db));
$b = mysqli_query($db, $rank_sql_2) or die(mysqli_error($db));
if (!$a or !$b) {
	mail($conf['admin_email'], 'error', "Error in updating ranks in cron. \n" . mysqli_error($db) . " \n in missing rank 1 query");
}
echo "reset ranks<br>\n";
mysqli_query($db, "UPDATE UserDetails SET salevel=9 WHERE salevel>9");
mysqli_query($db, "UPDATE UserDetails u1,UserDetails u2 SET u2.commandergold=0, u2.commander=0 WHERE u2.commander=u1.ID AND u1.active=0") or die(mysqli_error($db));
echo "set commanders<br>\n";
//$users = getActiveUsers() ;
//$dah = count($users);
$avgsa = 0;
$avgda = 0;
$avgca = 0;
$avgra = 0;
$avgtbg = 0;
$avgarmy = 0;
$avgup = 0;
mysqli_query($db, "UPDATE UserDetails SET officerup=0,commandergold=0,clickall=0,bankimg=1") or die(mysqli_error($db));
echo "done savings<br>\n";
$catchup = 1;
$q = mysqli_query($db, "select lastturntime from Mercenaries") or die(mysqli_error($db));
$r = mysqli_fetch_array($q, mysqli_ASSOC);
echo "mercs<br>\n";
$d = floor((time() - $r['lastturntime']) / 900) - 1;
if ($d > 2) {
	$catchup = $d;
}
if ($catchup > 4) {
	$usa_tbg = "UPDATE UserDetails SET bank=bank+((sasoldiers+dasoldiers+uu)*(22*1.2*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race=0 AND active=1";
	$other_tbg = "UPDATE UserDetails  SET bank=bank+((sasoldiers+dasoldiers+uu)*(22*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race!=0 AND race!=4 AND active=1";
	$russia_tbg = "UPDATE UserDetails SET bank=bank+((sasoldiers+dasoldiers+uu)*(18*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race=4 AND active=1";
} else {
	$usa_tbg = "UPDATE UserDetails SET gold=gold+((sasoldiers+dasoldiers+uu)*(22*1.2*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race=0 AND active=1";
	$other_tbg = "UPDATE UserDetails SET gold=gold+((sasoldiers+dasoldiers+uu)*(22*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race!=0 AND race!=4 AND active=1";
	$russia_tbg = "UPDATE UserDetails SET gold=gold+((sasoldiers+dasoldiers+uu)*(18*$catchup)),uu=(uu)+(up*$catchup),attackturns=attackturns+(2*$catchup) WHERE race=4 AND active=1";
}
mysqli_query($db, $usa_tbg) or die(mysqli_error($db));
echo "usa";
mysqli_query($db, $other_tbg) or die(mysqli_error($db));
mysqli_query($db, $russia_tbg) or die(mysqli_error($db));
echo "done tgb";
if ($allow_bonuses) {
	mysqli_query($db, "UPDATE UserDetails u,alliances a SET u.uu=u.uu+a.up WHERE u.alliance=a.id AND u.alliance>0 AND u.aaccepted>0") or die(mysqli_error($db));
}
echo "done alliance up<br>\n";
$q = mysqli_query($db, "SELECT sasoldiers,dasoldiers,uu,race,up,ID,commander,alliance,supporter,spies,specialforces,samercs,damercs FROM UserDetails WHERE active=1") or die(mysqli_query($db, ));
$c = 0;
$users = array();
while ($r = mysqli_fetch_object($q)) {
	$users[$c++] = $r;
}
echo "got $c active users <br>\n";
for ($i = 0;$i < $c;$i++) {
	
	$income = ($users[$i]->sasoldiers + $users[$i]->dasoldiers + $users[$i]->uu) * $conf["gold_from_soldier"] * $catchup;
	$b = $income;
	if ($conf["race"][$users[$i]->race]["income"]) {
		$b+= round(($income * $conf["race"][$users[$i]->race]["income"]) / 100);
	}
	//mysqli_query($db, "UPDATE UserDetails SET SA=$SA,DA=$DA,CA=$CA,RA=$RA WHERE active='1' AND ID='".$users[$i]->ID."'") or die(mysqli_error($db));
	if ($users[$i]->alliance > 0) {
		$allq = mysqli_query($db, "SELECT tax from alliances WHERE id={$users[$i]->alliance}") or die(mysqli_error($db));
		$alla = mysqli_fetch_object($allq);
		$a = floor($b * ($alla->tax));
		$b-= $a;
		mysqli_query($db, "UPDATE alliances a,UserDetails u SET a.gold=a.gold+FLOOR($b*a.tax) WHERE u.id={$users[$i]->ID} AND a.id={$users[$i]->alliance}") or die(mysqli_error($db));
	}
	$comBous = floor($b * 0.09);
	mysqli_query($db, "UPDATE UserDetails SET gold=gold+$comBous, commandergold=$comBous WHERE active='1' AND commander='" . $users[$i]->ID . "'") or die(mysqli_error($db));
	$OffBonus = floor($users[$i]->up * 0.03);
	mysqli_query($db, "UPDATE UserDetails SET officerup=officerup+$OffBonus WHERE active='1' AND ID='" . $users[$i]->commander . "'") or die(mysqli_error($db));
	$avgtbg+= $b / $c; //add to counter
	$avgarmy+= getTotalFightingForce($users[$i]) / $c; //Army size
	$avgup+= $users[$i]->up / $c; //UP
	echo "Did update for user: {$users[$i]->ID} <br> \n";
}
$q = mysqli_query($db, "SELECT up,ID,officerup FROM UserDetails WHERE active=1") or die(mysqli_query($db, ));
while ($r = mysqli_fetch_object($q)) {
	if ($r->officerup >= floor($r->up * 0.03)) {
		mysqli_query($db, "UPDATE UserDetails SET uu=uu+FLOOR(up*0.03),officerup=FLOOR(up*0.03) WHERE ID={$r->ID}") or die(mysqli_error($db));
	} else {
		mysqli_query($db, "UPDATE UserDetails SET uu=uu+officerup WHERE ID={$r->ID}") or die(mysqli_error($db));
	}
}
mysqli_free_result($q);
$avgsql = "SELECT floor(sum(sa)/count(*)) as avgsa, floor(sum(da)/count(*)) as avgda, floor(sum(ca)/count(*)) as avgca, floor(sum(ra)/count(*)) as avgra FROM UserDetails where active=1";
$avq = mysqli_query($db, $avgsql) or die(mysqli_error($db));
$avr = mysqli_fetch_array($avq, mysqli_ASSOC);
$avgsa = 0;
$avgda = 0;
$avgca = 0;
$avgra = 0;
$avghit = 0;
$t = time() - (60 * 60 * 24);
$q = mysqli_query($db, "SELECT (SUM(gold)/count(*)) as avghit FROM AttackLog WHERE gold>0 AND time>$t") or die(mysqli_error($db));
$aha = mysqli_fetch_object($q);
$avghit = $aha->avghit;
$avgarmy = floor($avgarmy);
$avgsa = $avr['avgsa'];
$avgda = $avr['avgda'];
$avgca = $avr['avgca'];
$avgra = $avr['avgra'];
$avgtbg = floor($avgtbg);
$avgup = floor($avgup);
$UpdateSQL = "UPDATE Mercenaries ";
$UpdateSQL.= " SET attackSpecCount=attackSpecCount+'{$conf['mercenaries_per_turn']}', defSpecCount =defSpecCount +'{$conf['mercenaries_per_turn']}',  ";
$UpdateSQL.= " lastturntime='" . time() . "', ";
$UpdateSQL.= " avgarmy='$avgarmy',avghit='$avghit',avgtbg='$avgtbg',avgup='$avgup',avgsa='$avgsa',avgda='$avgda',avgca='$avgca', ";
$UpdateSQL.= " avgra='$avgra';";
mysqli_query($db, $UpdateSQL) or die(mysqli_error($db));
echo "updated Turn data <br>\n";
$q = mysqli_query($db, "SELECT * FROM UserDetails WHERE active=1") or die(mysqli_error($db));
while ($user = mysqli_fetch_object($q)) {
	updateUserStats($user);
}
$q = mysqli_query($db, "SELECT ID FROM UserDetails WHERE active=1 ORDER BY SA DESC") or die(mysqli_error($db));
$i = 1;
echo "Doing SA ========= <br>";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$update = mysqli_query($db, "UPDATE Ranks SET sarank=$i WHERE userID=" . $row[ID]) or die(mysqli_error($db));
	$i++;
	echo "UPDATE Ranks SET sarank=$i WHERE userID=$row[ID]<br>\n";
}
$q = mysqli_query($db, "SELECT ID FROM UserDetails WHERE active=1 ORDER BY DA DESC") or die(mysqli_error($db));
$i = 1;
echo "Doing DA ========= <br>";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$update = mysqli_query($db, "UPDATE Ranks SET darank=$i WHERE userID=" . $row[ID]) or die(mysqli_error($db));
	$i++;
	echo "UPDATE Ranks SET defenseActionRank=$i WHERE userID=$row[ID]<br>\n";
}
$q = mysqli_query($db, "SELECT ID FROM UserDetails WHERE active=1 ORDER BY CA DESC") or die(mysqli_error($db));
$i = 1;
echo "Doing CA ========= <br>";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$update = mysqli_query($db, "UPDATE Ranks SET carank=$i WHERE userID=" . $row[ID]) or die(mysqli_error($db));
	$i++;
	echo "UPDATE Ranks SET carank=$i WHERE userID=$row[ID]<br>\n";
}
$q = mysqli_query($db, "SELECT ID,active FROM UserDetails WHERE active=1 ORDER BY RA DESC") or die(mysqli_error($db));
$i = 1;
echo "Doing RA ========= <br>";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$update = mysqli_query($db, "UPDATE Ranks SET rarank=$i,active=" . $row[active] . " WHERE userID=" . $row[ID]) or die(mysqli_error($db));
	$i++;
	echo "UPDATE Ranks SET rarank=$i WHERE userID=$row[ID]<br>\n";
}
$q = mysqli_query($db, "SELECT * FROM Ranks where active=1") or die(mysqli_error($db));
echo "Setting ranbk float;<br>";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$f = ($row[rarank] + $row[carank] + $row[sarank] + $row[darank]) / 4;
	$update = mysqli_query($db, "UPDATE Ranks SET rankfloat=$f WHERE userID=" . $row[userID]) or die(mysqli_error($db));
	echo "UPDATE Ranks SET rankfloat=$f WHERE userID=$row[userID]<br>\n";
}
$q = mysqli_query($db, "SELECT userID FROM Ranks WHERE active=1  ORDER BY rankfloat ASC") or die(mysqli_error($db));
$i = 1;
echo "Updating ranks<br>\n";
while ($row = mysqli_fetch_array($q, mysqli_ASSOC)) {
	$update = mysqli_query($db, "UPDATE Ranks SET rank=$i WHERE userID=" . $row[userID]) or die(mysqli_error($db));
	$i++;
	echo "UPDATE Ranks SET rank=$i WHERE userID=$row[userID]<br>\n";
}
deleteoldusers();
echo "Deleted old users<br>\n";
//====== Alliance stuff ====
mysqli_query($db, "
				UPDATE alliances a,UserDetails u 
				SET 
					a.leaderid3=0 
				WHERE a.leaderid3=u.ID and u.active!=1
			") or die(mysqli_error($db));
mysqli_query($db, "
				UPDATE alliances a,UserDetails u 
				SET 
					a.leaderid2=a.leaderid3,
					a.leaderid3=0 
				WHERE a.leaderid2=u.ID and u.active!=1
			") or die(mysqli_error($db));
mysqli_query($db, "
				UPDATE alliances a,UserDetails u 
				SET 
					a.leaderid1=a.leaderid2,
					a.leaderid2=a.leaderid3,
					a.leaderid3=0 
				WHERE a.leaderid1=u.ID and u.active!=1
			") or die(mysqli_error($db));
?>
