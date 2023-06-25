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
	
	 <?php $q = mysqli_query($db, "SELECT * FROM Mercenaries") or die(mysqli_error($db));
$qa = mysqli_fetch_array($q, MYSQLI_ASSOC);
$t = time() - (60 * 60 * 23 * 3);
$q2 = mysqli_query($db, "SELECT (sum(exp)/count(*)) as e,(sum(bank)/count(*)) as b  FROM UserDetails WHERE lastturntime>$t") or die(mysqli_error($db));
$q3 = mysqli_query($db, "SELECT sum(gold) as g FROM UserDetails WHERE active=1") or die(mysqli_error($db));
$qb = mysqli_fetch_array($q2, MYSQLI_ASSOC);
$qc = mysqli_fetch_array($q3, MYSQLI_ASSOC);
?>
	<center><table class='table_lines' width="500px" cellPadding=6><TR><Th colspan="2" class="subh">Average Stats for previous turn</th></TR>
	<tr><TD width="50%">Average Strike Action</TD><td><?php isset($qa["avgsa"]) ? numecho($qa["avgsa"]) : 0; ?></td></tr>
	<tr><TD>Average Defence Action</TD><td><?php isset($qa["avgda"]) ? numecho($qa["avgda"]) : 0; ?></td></tr>
	<tr><TD>Average Covert Action</td><td><?php isset($qa["avgca"]) ? numecho($qa["avgca"]) : 0; ?></td></tr>
	<tr><TD>Average Retaliation Action</TD><td><?php isset($qa["avgra"]) ? numecho($qa["avgra"]) : 0; ?></td></tr>
	<tr><TD>Average Unit Production</TD><td><?php isset($qa["avgup"]) ? numecho($qa["avgup"]) : 0; ?></td></tr>
	<tr><TD>Average Army Size</TD><td><?php isset($qa["avgarmy"]) ? numecho($qa["avgarmy"]) : 0; ?></td></tr>
	<tr><TD>Average Gold Income</TD><td><?php isset($qa["avgtbg"]) ? numecho($qa["avgtbg"]) : 0; ?></td></tr>
	<tr><TD>Average Gold Hit</TD><td><?php isset($qa["avghit"]) ? numecho($qa["avghit"]) : 0; ?></td></tr>
	<tr><TD>Average Bank size</TD><td><?php isset($qa["b"]) ? numecho($qb['b']) : 0; ?></td></tr>
	<tr><TD>Average Experience</TD><td><?php isset($qa["e"]) ? numecho($qb['e']) : 0; ?></td></tr>
	<tr><TD>Total Gold in Battlefield</TD><td><?php isset($qa["g"]) ? numecho($qc['g']) : 0; ?></td></tr>
	</table>  </center>
	 
	 <?php
include ("bottom.php");
?>	

	  </TD></TR></TBODY></TABLE></BODY></HTML>
<?php include "gzfooter.php"; ?>