<?php $w = 48; $w2 = 142 + 38; ?>
<TABLE bgcolor="#000000" cellSpacing=0 cellPadding=0 width=137 border=0>
  <TBODY>
    <?php if (!$_SESSION['isLogined']) { ?>
    <TD width="<?=$w+209?>">  
	<?php for ($xxx = 0;$xxx <= rand(0, 4);$xxx++) {
		echo "<form></form>";
	} ?> 
      <FORM method=post>
	    
        <INPUT type=hidden name=username><INPUT type=hidden name=pword>
        <TABLE class=small style="padding-left: 15px; padding-right: 0px; padding-top: 0px;border-color: red;border-width:10px; padding-bottom: 5px" width=130 align=center cellspacing="0" cellpadding="0">
        	<TBODY>
        		<TR>
        			<td width="<?=$w+204?>" bgcolor="#000000" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
        				<p align="left">
        					<img src="pic/navigation_r1_c1.gif" width="<?=$w+142?>" height="72">
						</p>
					</td>
        		</TR>
        		<tr>
              		<td width="<?=$w+204?>">
						<p align="center">
                  			<FONT color=White>Username:</FONT>
				  		</p>
				  	</td>
                </tr>          
            	<TR>
              		<TD align=middle width="<?=$w+139?>">
                		<INPUT class=login_input name='<?php $_SESSION['uname'] = genUniqueTxt(10);
	echo $_SESSION['uname']; ?>'>
              		</TD>
            	</TR>
				<tr>
            		<TD align=middle width="<?=$w+139?>">
              			<p align="center">
                			<FONT color=White>Password:</FONT>
              			</p>
            		</TD>
            	</TR>
            	<TR>
              		<TD align=middle width="<?=$w+139?>">
                		<INPUT class=login_input type=password name='<?php $_SESSION['psword'] = genUniqueTxt(10);
	echo $_SESSION['psword']; ?>'>
              		</TD>
            	</TR>
            	<TR>
              		<TD style="PADDING-TOP: 5px" align="middle" width="<?=$w+142?>">
                		<INPUT class=login_input style="WIDTH: 50px" type=submit value=Login>
              		</TD>
           	 	</TR>				
				<TR>
            		<TD class="menu_cell_repeater_vert" width="<?=$w+67?>"  align="middle" width="<?=$w+142?>">
              			<p align="center">
                			<div><A  href="register.php">Register</A></div>
              				<div><A href="forgotpass.php">Forgot Login?</A></div>
						</p>
              			<br />
              			<img src="pic/navigation_r11_c1.gif" width="<?=$w+142?>" height="10" />
					</TD>
          		</TR>         
		  </TBODY>
        </TABLE>
		
		 </FORM>
		  <?php for ($xxx = 0;$xxx <= rand(0, 4);$xxx++) {
		echo "<form></form>";
	} ?>
        <?php
} else { ?>
        <TABLE>
          <TR>
            <TD class="menu_cell_repeater_vert" width="<?=$w+142?>" vAlign=top   align=middle>
              <center>
                <img src="pic/Top.gif" width="<?=$w+142?>" height="10" border="0">
              </center><a href="base.php">
          <center>
             Base
          </center>
          </a>
          <a href="battlefield.php">
          <center>
             Battlefield
          </center>
          </a>
          <!-- <hr> -->
          <!--<a href="nuke.php">
          <center>
             Nuclear Research
          </center>
          </a>-->
          </a>
          <a href="armory.php"><center>
             Armory
          </center>
          </a>
          <a href="train.php">
          <center>
             Training
          </center>
          </a>
          <a href="mercs.php">
          <center>
             Mercenaries
          </center>
          </a>
          <a href="upgrades.php" >
          <center>
             Upgrades
          </center>
          </a>
          <a href="attacklog.php">
          <center>
             Attack Log
          </center>
          </a><a href="intel.php">
          <center>
             Intel
          </center>
          </a>
          <a href="bank.php">
          <center>
             Treasury
          </center>
          </a>
          <hr>
          <a href="logout.php">
          <center>
             Logout
          </center>
          </a>
          <img src="pic/Bottom.gif" width="<?=$w+142?>" height="10">
            </TD>
          </TR>
          <?php
}
?>
          </TBODY>
        </TABLE>
        <P>
          <?php
if ($_SESSION['isLogined']) {
	$userR = getUserRanks($_SESSION['isLogined']);
	if (!$user) {
		$user = getUserDetails($_SESSION['isLogined']);
	}
?>
          <TABLE  bgcolor="#000000" cellSpacing=0 cellPadding=0 width=142 border=0>
            <TR>
              <TD 
                align=center style="FONT-SIZE: 8pt; COLOR: white">
                <div align="left">
                  <img src="pic/Top.gif" width="<?=$w+142?>" height="13">
                </div>
              </TD>
              <TD style="FONT-SIZE: 8pt">&nbsp;
                 
              </TD>
            </TR>
            <TBODY>
              <td class="menu_cell_repeater_vert" width="<?=$w+142?>" align="middle" valign="top" bgcolor="#4d4d4d" style=" display : table-cell; overflow : hidden; padding-left : 2px; padding-right : 2px; width : 142px;">
                <TABLE cellSpacing=0 cellPadding=3 style="width: 100%;">
                  <TBODY>
                    <TR>
                      <TD width="45%" align="left" style="FONT-SIZE:11px; COLOR: white; padding-left: 15px;">
                         Rank:
                      </TD>
                      <TD width="55%" style="FONT-SIZE: 11px">
                        <?php numecho($userR->rank)
?>
                      </TD>
                    </TR>
                    <TR>
                      <TD style="FONT-SIZE: 11px; COLOR: white; padding-left: 15px;" align="left">
                         Turns:
                      </TD>
                      <TD style="FONT-SIZE: 11px">
                        <FONT color=white><?php numecho($user->attackturns) ?></FONT>
                      </TD>
                    </TR>
                    <TR>
                      <TD style="FONT-SIZE: 11px; COLOR: white; padding-left: 15px;" align="left">
                         Gold:
                      </TD>
                      <TD style="FONT-SIZE: 11px">
                        <FONT color=white>
                <?php numecho($user->gold) ?>
                        </FONT>
                      </TD>
                    </TR>
                    <TR>
                      <TD style="FONT-SIZE: 11px; COLOR: white; padding-left: 15px;" align=left>
                         <a href="bank.php" style="color: white; font-size: 11px; font-weight: normal;">Treasury:</a>
                      </TD>
                      <TD style="FONT-SIZE: 11px">
                        <FONT color=white size="small"><a href="bank.php" style="color: white; font-size: 11px;font-weight: normal;">
                <?php numecho($user->bank) ?></a>
                        </FONT>
                      </TD>
                    </TR>
                    <TR>
                      <TD style="FONT-SIZE: 11px; COLOR: white; padding-left: 15px;" align=left>
                         EXP:
                      </TD>
                      <TD style="FONT-SIZE: 11px">
                        <FONT color=white>
                <?php numecho($user->exp) ?>
                        </FONT>
                      </TD>
                    </TR>
                    <TR>
                      <TD style="FONT-SIZE: 11px; COLOR: white; padding-left: 15px;" align=left>
                         Next Turn:
                      </TD>
                      <TD style="FONT-SIZE: 11px">
                        <div id="idTimer" style="color: white;">
                          <span id="idMin" style="font-weight: bold; font-size: 11px;">Getting Time</span>:<span id="idSec" style="font-weight: bold; font-size: 8pt;"></span>
                        </div>
                        <script language="JavaScript" src="javafunctions.js">
								 
				
				</script><script language="JavaScript">
				
					StartTimer();
					
					
					</script>
				
				<?php
	$temp = explode(":", $nextTurnMin = getNextTurn($user));
	$min = intval($temp[0]);
	$sec = intval($temp[1]);
	echo "<script language=\"JavaScript\"> \n";
	echo "<!-- \n";
	echo "var min=$min; \n";
	echo "var sec=$sec; \n";
	echo "-->\n";
	echo "</script> \n";
	//$nextTurnMin=round($nextTurnMin/60);
	
?>
                      </TD>
                    </TR>
                    <TR>
                      <TD height="24"  align=left style="FONT-SIZE: 10px; COLOR: white; padding-left: 15px;">
                         Messages:
                      </TD>
                      <TD >
                        <div>
                          <A class="messagesUR" href="messages.php">
                          	<?=getNewMessageCount($user->ID) ?>                          	
                          </A>
                         
                          <A class="messagesR" href="messages.php">&nbsp;(<?=getMessagesCount($user->ID) ?>) Read</A>
                          
                          </div>
                          </TD>
                          </TR>
                          </TBODY>
                          </TABLE>
                          </TD>
                          </TR>
                          </TBODY>
                          <TR>
                            <TD style="FONT-SIZE: 6pt; COLOR: white" 
                align=center>
                              <div align="left">
                                <img src="pic/Bottom.gif" width="<?=$w+142?>" height="12">
                              </div>
                            </TD>
                            <TD style="FONT-SIZE: 6pt">&nbsp;
                               
                            </TD>
                          </TR>
                          </TABLE>
                          <?php
}
?>
                          <p>
                            <TABLE bgcolor="#000000" cellSpacing=0 cellPadding=0 width=142 border=0>
                              <TBODY>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Top.gif" width="<?=$w+142?>" height="13">
                                    </div>
                                  </TD>
                                </TR>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <!-- <P align=center>
                                      <FONT color=#ff0000><a href="online.php">
          <?=getOnlineUsersCount() /* + $number=rand(100,105)*/;;
?> online</a> </FONT>
                                    </P> -->
                                    <p align="center">
                                      <a href='battlefield.php?page=1'>Rankings</a>
                                    </p>
                                    <p align="center">
                                      <a href='statistics.php'>Statistics</a>
                                    </p>
                                    <p align="center"><a href='hof.php'>Previous Age<br>Statistics</a></p>
                                    <!-- <p align="center">
                                      <a href='chat.php' target="_blank">Chat</a>
                                    </p>
									 <p align="center">
                                      <a href='wiki' target="_blank">Help</a>
                                    </p>
                                    <p align="center">
                                      <a href='http://ww2game.net/forum'>Forum</a>
                                    </p>
                                  </TD>
                                </TR> -->
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Bottom.gif" width="<?=$w+142?>" height="12">
                                    </div>
                                  </TD>
                                </TR>
                                <tr>
                                </tr>
                              </TBODY>
                            </TABLE>
                          </p>
                          <p>
                            <TABLE bgcolor="#000000" cellSpacing=0 cellPadding=0 width=142 border=0>
                              <TBODY>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Top.gif" width="<?=$w+142?>" height="13">
                                    </div>
                                  </TD>
                                </TR>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <P align=center>
                                      <FONT color=#ff0000>
          <?php
echo gmdate("l");
echo "<br>";
echo (gmdate("jS F y"));
echo "<br>";
echo (gmdate("h:i A T"));
echo " ";
/* june 9, 06. Fixed the wrong date; server is using EST+12 as unix time... */
?>
                                      </FONT>
                                    </P>
                                  </TD>
                                </TR>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Bottom.gif" width="<?=$w+142?>" height="12">
                                    </div>
                                  </TD>
                                </TR>
                                <tr>
                                </tr>
                              </TBODY>
                            </TABLE>
                          </p>
                         
                          <!-- <p>
                            <TABLE bgcolor="#000000" cellSpacing=0 cellPadding=0 width=142 border=0>
                              <TBODY>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Top.gif" width="<?=$w+142?>" height="13">
                                    </div>
                                  </TD>
                                </TR>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align=center border="0" style="color: white;">
                                      
                                    </div>
                                  </TD>
                                </TR>
                                <TR>
                                  <TD class=menu_cell_repeater_vert>
                                    <div align="left">
                                      <img src="pic/Bottom.gif" width="<?=$w+142?>" height="12">
                                    </div>
                                  </TD>
                                </TR>
                                <tr>
                                </tr>
                              </TBODY>
                            </TABLE>
                          </p> -->






