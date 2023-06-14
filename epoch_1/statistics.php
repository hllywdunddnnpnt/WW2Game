<?php include "gzheader.php";
include "scripts/vsys.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE><?php echo $conf["sitename"]; ?> :: Statistics</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1"><!-- ZoneLabs Privacy Insertion -->
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
      <TD style="PADDING-RIGHT: 15px; PADDING-LEFT: 15px; PADDING-TOP: 12px" 
    vAlign=top align=left>
	
	 <BR>
	 
	 <?php $q = mysqli_query($db, "SELECT * FROM Mercenaries") or die(mysqli_error($db));
$qa = mysqli_fetch_array($q, mysqli_ASSOC);
$t = time() - (60 * 60 * 23 * 3);
$q2 = mysqli_query($db, "SELECT (sum(exp)/count(*)) as e,(sum(bank)/count(*)) as b  FROM UserDetails WHERE lastturntime>$t") or die(mysqli_error($db));
$q3 = mysqli_query($db, "SELECT sum(gold) as g FROM UserDetails WHERE active=1") or die(mysqli_error($db));
$qb = mysqli_fetch_array($q2, mysqli_ASSOC);
$qc = mysqli_fetch_array($q3, mysqli_ASSOC);
?>
	<center><table class='table_lines' width="85%"><TR><TD colspan="2"><b>Average Stats for previous turn</b></TD></TR>
	<tr><TD>Average Strike Action</TD><td><?php numecho($qa[avgsa]); ?></td></tr>
	<tr><TD>Average Defence Action</TD><td><?php numecho($qa[avgda]); ?></td></tr>
	<tr><TD>Average Covert Action</td><td><?php numecho($qa[avgca]); ?></td></tr>
	<tr><TD>Average Retaliation Action</TD><td><?php numecho($qa[avgra]); ?></td></tr>
	<tr><TD>Average Unit Production</TD><td><?php numecho($qa[avgup]); ?></td></tr>
	<tr><TD>Average Army Size</TD><td><?php numecho($qa[avgarmy]); ?></td></tr>
	<tr><TD>Average Gold Income</TD><td><?php numecho($qa[avgtbg]); ?></td></tr>
	<tr><TD>Average Gold Hit</TD><td><?php numecho($qa[avghit]); ?></td></tr>
	<tr><TD>Average Bank size</TD><td><?php numecho($qb['b']); ?></td></tr>
	<tr><TD>Average Experience</TD><td><?php numecho($qb['e']); ?></td></tr>
	<tr><TD>Total Gold in Battlefield</TD><td><?php numecho($qc['g']); ?></td></tr>
	</table>  </center>
	 
	 <?php
include ("bottom.php");
?>	

	  </TD></TR></TBODY></TABLE></BODY></HTML>
<?php include "gzfooter.php"; ?>