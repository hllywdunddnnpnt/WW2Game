<?php include "gzheader.php";
include "scripts/vsys.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?php echo $conf["sitename"]; ?> :: Battlefield</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1"><!-- ZoneLabs Privacy Insertion -->
<SCRIPT language=javascript src="js/js"></SCRIPT>
<script language="javascript" type="text/javascript" src="prototype.js"></script>
        <script language="javascript" type="text/javascript" src="javafunctions.js"></script>
<LINK href="css/common.css" type=text/css rel=stylesheet>
<SCRIPT language=javascript type=text/javascript>
		<!--
		function checkCR(evt) {
		var evt = (evt) ? evt : ((event) ? event : null);
		var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
		if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
		}
		document.onkeypress = checkCR;
		//-->
		</SCRIPT>

<META content="MSHTML 5.50.4522.1800" name=GENERATOR></HEAD>
<BODY text=#ffffff bgColor=#000000 leftMargin=0 topMargin=0 marginheight="0" 
marginwidth="0"  onload="gm(<?=$user->ID ?>);">
<?php
include "top.php";
?>
<TABLE cellSpacing=0 cellPadding=5 width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=menu_cell_repeater style="PADDING-LEFT: 15px" vAlign=top width=140>
<?php
include ("left.php");
?>
	</TD>
      <TD style="PADDING-RIGHT: 15px; PADDING-LEFT: 15px; PADDING-TOP: 12px" 
    vAlign=top align=left>
	
	 <BR>
      <TABLE class=table_lines cellSpacing=0 cellPadding=6 width="100%" 
border=0>
          <TBODY>
            <TR> 
              <TH class="subh" colspan="5">Battlefield</TH>
			</tr>
            <TR> 
              <TH style="text-align: center; width: 20%;">Rank</TH>
              <TH style="text-align: left; width: 30%;">Name</TH>
              <?php
$attacker = $user;
if ($attacker->supporter > 0) {
	echo "<th>Offensive Type</th>";
}
?>
              <TH style="text-align: center; width: 20%;" colSpan="2">Army Size</TH>
              <TH style="text-align: right; width: 30%;">Treasury</TH>
            </TR>
            <?php
if (!is_numeric($cgi['page']))
	{
		$cgi['page'] = 1;
	}
else if (!$cgi['page'] AND !$cgi['search']) {
	$u = getUserRanks($_SESSION['isLogined']);
	$ur = $u->rank;
	$count = getActiveUsersCount();
	$cgi['page'] = floor(($ur) / ($conf["users_per_page"])) + 1;
}

if ($cgi['search']) {
	$strS = $cgi['search'];
	if ($cgi['search_type'] == 's') {
		$strS.= "%";
	} elseif ($cgi['search_type'] == 'c') {
		$strS = "%" . $strS . "%";
	} else {
		$strS = "%" . $strS;
	}
	$users = searchRanksUsersList($cgi['page'], $strS);
} else {
	$users = getRanksUsersList2($cgi['page']);
}
$all_cache = array();
//echo "<!-- ";print_r($users);echo " -->";
if (isset($users) && is_countable($users)){
for ($i = 0;$i < count($users);$i++) {
	$tag = '';
	if (in_array($users[$i]->alliance, $all_cache) AND !isset($all_cache[$users[$i]->alliance])) {
		$tag = $all_cache[$users[$i]->alliance];
	} elseif ($users[$i]->alliance > 0 AND $users[$i]->aaccepted > 0) {
		$qal = mysqli_query($db, "SELECT tag FROM alliances WHERE ID='{$users[$i]->alliance}'") or die(mysqli_error($db));
		$r = mysqli_fetch_array($qal, MYSQLI_ASSOC);
		$all_cache[$users[$i]->alliance] = $r['tag'];
		if ($r['tag']) {
			$tag = "[" . $r['tag'] . "]";
		} else {
			$tag = '';
		}
	}
	//if($users[$i]->alliance==0){$tag="";}
	
?>
			<TR> 
              <TD style="PADDING-RIGHT: 20px; text-align: center;"><?php numecho($users[$i]->rank); ?></TD>
              <TD style="text-align: left;"><A  href="stats.php?id=<?=$users[$i]->ID ?>"><?php echo $users[$i]->userName ?></A>&nbsp;<?=$tag ?></TD>
              <?php if ($attacker->supporter > 0) {
		echo "<td><a href='attack.php?numspies=1&defender_id=" . ($users[$i]->ID) . "&mission_type=recon'>Spy</a>
              			&nbsp;<a href='attack.php?defender_id2=" . ($users[$i]->ID) . "&amp;attackbut=Balanced!'>Attack</a>
              </td>";
	}
?>
              
              
                   <TD style="text-align: right; width: 10%;"><?php
	numecho(getTotalFightingForce($users[$i]));
?></TD>
              <TD style="text-align: left; width: 10%;"><?=$conf["race"][$users[$i]->race]["name"] ?></TD>
              <TD style="PADDING-RIGHT: 20px; text-align: right;"><?php
	$rn = (rand(90, 110) / 100);
	$dC = $users[$i]->CA;
	$aC = $attacker->CA;
	if (($users[$i]->ID != $attacker->ID) AND (($dC * $rn) > $aC or !$_SESSION['isLogined'])) {
		echo "??????";
	} else {
		numecho($users[$i]->gold);
	}
	// echo "<!--$rn $dC";print_r($users[$i]); echo " $aC-->";
	
?> Gold</TD>
            </TR>
			<?php
}}
?>
            <TR> 
              <TD><?php
if ($cgi['search']) {
	$activeUsersC = searchRanksUsersListCount($strS);
} else {
	$activeUsersC = getActiveUsersCount();
}
$pCount = $activeUsersC / $conf["users_per_page"];
//echo $pCount;
$pCountF = floor($pCount);
$pCountF+= (($pCount > $pCountF) ? 1 : 0);
if ($cgi['page'] > 1) {
	echo "<A href='battlefield.php?page=" . ($cgi['page'] - 1) . "&search=" . $cgi['search'] . "&search_type=" . $cgi['search_type'] . "'>&lt;&lt; Previous</A>";
} else {
	echo "&nbsp;";
}
?>
			  </TD>
              <TD style="text-align: left;" colSpan=3><?php numecho($activeUsersC) ?> players total | page <?=$cgi['page'] ?> of <?php numecho($pCountF); ?></TD>
              <TD style="text-align: right;"><?php
if ($cgi['page'] < $pCountF) {
	echo '<A href="battlefield.php?page=' . ($cgi['page'] + 1) . '&search=' . $cgi["search"] . '&search_type=' . $cgi["search_type"] . '">Next &gt;&gt;</A>';
} else {
	echo "&nbsp;";
}
?>
			</TD>
            </TR>
          </TBODY>
        </TABLE>
      <P>
      <FORM action=battlefield.php method=get>
      <TABLE class=table_lines cellSpacing=0 cellPadding=6 width=550 
      align=center border=0>
        <TBODY>
        <TR>
          <TH align=middle colSpan=2>Search</TH></TR>
        <TR>
          <TD align=right>Jump to page:</TD>
          <TD align=left><INPUT maxLength=5 size=5 name=page> <INPUT type=submit value=Go></TD></TR>
        <TR>
          <TD align=right>Search by username:</TD>
          <TD align=left><SELECT name=search_type> <OPTION value=s selected 
              label="starts with">starts with</OPTION> <OPTION value=c 
              label="contains">contains</OPTION> <OPTION value=e 
              label="ends with">ends with</OPTION></SELECT> <INPUT name=search> <INPUT type=submit value=Go></TD></TR></TBODY></TABLE></FORM>
      <P>                    
      <?php
include ("bottom.php");
?>	

	  </TD></TR></TBODY></TABLE></BODY></HTML>

<?php include "gzfooter.php"; ?>