<?php include "gzheader.php";
include "scripts/vsys.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?php echo $conf["sitename"]; ?> :: Intelligence</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<SCRIPT language=javascript src="js/js"></SCRIPT>
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
marginwidth="0">
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
    <TD style="PADDING-RIGHT: 15px; PADDING-LEFT: 15px; PADDING-TOP: 12px" vAlign=top align=left>
      <?php include "islogined.php"; ?>
      <TABLE class=table_lines cellSpacing=0 cellPadding=6 width="100%" 
border=0>
          <TBODY>
            <TR> 
              <TH align=middle colSpan=5>Intercepted Intelligence Operations</TH>
            </TR>
            <TR> 
              <TH class=subh>&nbsp;</TH>
              <TH class=subh align=left>Time</TH>
              <TH class=subh align=left>Enemy</TH>
              <TH class=subh align=right>Mission Type</TH>
              <th class="subh" align="right">Result</th>
              <TH class=subh align=right>Number of Spies</TH>
              <TH class=subh align="center">Details</TH>
            </TR>
			<?php
if (!$cgi['page1']) {
	$cgi['page1'] = 1;
}
$attackA1 = getSpyByDefender($user->ID, $cgi['page1']);
for ($i = 0;$i < count($attackA1);$i++) {
?>
            <TR>
              <Td >&nbsp;</Td>
              <Td  align=left><?php echo vDate($attackA1[$i]->time); ?></Td>
              <Td align=left>
                <?php
	$tus = getUserDetails($attackA1[$i]->userID, "userName");
	if ($tus) {
		echo "<a href='stats.php?id={$attackA1[$i]->userID}'>" . $tus->userName . "</a>";
	} else {
		echo "Already no such user";
	}
?>
              </Td>
              <Td  align=right><?php if ($attackA1[$i]->type == 0) {
		echo "Recon";
	} else {
		echo "Thievery";
	} ?></Td>
              <td align="right"><?php echo (($attackA1[$i]->isSuccess) ? "Success" : "Failed"); ?></td>
              <Td  align=right><?php numecho($attackA1[$i]->spies); ?></Td>
              <td align="center"><a href='spylog.php?id=<?=$attackA1[$i]->ID ?>&amp;isview=1'>Details</a></td>
            </TR>
			<?php
} ?>
            <TR> 
              <TD colSpan=2> 
                <?php if ($cgi['page1'] > 1) {
	echo "<nobr><A href='intel.php?page1=" . ($cgi['page1'] - 1) . "'>&lt;&lt; Prev</A></nobr>";
} else {
	echo "&nbsp;";
}
?>
              </TD>
              <TD align=middle colSpan=2> 
                <?php
$attacks1C = getSpyByDefenderCount($user->ID);
$pCount1 = $attacks1C / $conf["users_per_page"];
$pCountF1 = floor($pCount1);
$pCountF1+= (($pCount1 > $pCountF1) ? 1 : 0);
numecho($attacks1C);
?>
                operations total | page 
                <?php numecho($cgi['page1']); ?>
                of 
                <?php numecho($pCountF1); ?>
              </TD>
              <TD> 
                <?php if ($cgi['page1'] < $pCountF1) {
	echo "<nobr><A href='intel.php?page1=" . ($cgi['page1'] + 1) . "'>Next &gt;&gt;</A></nobr>";
} else {
	echo "&nbsp;";
}
?>
              </TD>
            </TR>
          </TBODY>
        </TABLE>
      <P>
        <TABLE class=table_lines cellSpacing=0 cellPadding=6 width="100%" 
border=0>
          <TBODY>
            <TR> 
              <TH align=middle colSpan=6>Intelligence Files</TH>
            </TR>
            <TR> 
              <TH class=subh align=left>Time</TH>
              <TH class=subh align=left>Enemy</TH>
              <TH class=subh align=right>Mission Type</TH>
              <TH class=subh align=right>Result</TH>
              <TH class=subh align=right>Number of Spies</TH>
              <TH class=subh>Detailed Report</TH>
            </TR>
            <?php
if (!$cgi['page2']) {
	$cgi['page2'] = 1;
}
$attackA2 = getSpyBySpyer($user->ID, $cgi['page2']);
for ($i = 0;$i < count($attackA2);$i++) {
?>
			<TR> 
              <Td align=left ><?php if ($_SESSION['admin']) {
		echo "<div title=\"{$attackA2[$i]->time}\" >" . date("H:i:s n j", $attackA2[$i]->time) . "</div>";
	} else {
		echo vDate($attackA2[$i]->time);
	} ?></Td>
              <Td align=left >
                <?php
	$tus = getUserDetails($attackA2[$i]->toUserID, "userName");
	if ($tus) {
		echo "<a href='stats.php?id={$attackA2[$i]->toUserID}'>" . $tus->userName . "</a>";
	} else {
		echo '{' . $tus->userName . '}';
	}
?>
              </Td>
              <Td align=right ><?php if ($attackA2[$i]->type == 0) {
		echo "Recon";
	} else {
		echo "Thievery";
	} ?></Td>
              <Td align=right >
                <?php echo (($attackA2[$i]->isSuccess) ? "Success" : "Failed"); ?>
              </Td>
              <Td align=right>
                <?php numecho($attackA2[$i]->spies); ?>
              </Td>
              <Td ><a href="spylog.php?id=<?=$attackA2[$i]->ID ?>&amp;isview=1">details</a></Td>
            </TR>
<?php
} ?>			
            <TR> 
              <TD align=middle colSpan=6> <TABLE class="" cellSpacing=0 cellPadding=0 width="100%" border=0>
                  <TBODY>
                    <TR> 
                      <TD 
                style="BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none"> 
                        <?php if ($cgi['page2'] > 1) {
	echo "<nobr><A href='intel.php?page2=" . ($cgi['page2'] - 1) . "'>&lt;&lt; Prev</A></nobr>";
} else {
	echo "&nbsp;";
}
?>
                      </TD>
                      <TD 
                style="BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none" 
                align=middle> 
                        <?php
$attacks2C = getSpyBySpyerCount($user->ID);
$pCount2 = $attacks2C / $conf["users_per_page"];
$pCountF2 = floor($pCount2);
$pCountF2+= (($pCount2 > $pCountF2) ? 1 : 0);
numecho($attacks2C);
?>
                        files total | page 
                        <?php numecho($cgi['page2']); ?>
                        of 
                        <?php numecho($pCountF2); ?>
                      </TD>
                      <TD 
                style="BORDER-RIGHT: medium none; BORDER-TOP: medium none; BORDER-LEFT: medium none; BORDER-BOTTOM: medium none"> 
                        <?php if ($cgi['page2'] < $pCountF2) {
	echo "<nobr><A href='intel.php?page2=" . ($cgi['page2'] + 1) . "'>Next &gt;&gt;</A></nobr>";
} else {
	echo "&nbsp;";
}
?>
                      </TD>
                    </TR>
                  </TBODY>
                </TABLE></TD>
            </TR>
          </TBODY>
        </TABLE>
    <?php
include ("bottom.php");
?>	
</TD></TR></TBODY></TABLE></BODY></HTML>
<?php include "gzfooter.php"; ?>
