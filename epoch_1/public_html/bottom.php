<CENTER>
      <P>
      <P><FONT style="FONT-SIZE: 8pt">| <A 
      href="spam.php">Report Spam</A> | <A 
      href="privacy.php">Privacy Policy</A> | <A 
      href="tos.php">Terms of Service</A> | 

      <P><!-- see README for credits -->
        Epoch 1 design by SilentWarrior and Xamir<br>
        <I>Copyright ww2game.net 2005-2010<BR>
<?php echo $conf["sitename"]; ?>, All rights reserved.</I><BR>
      </P>
      <P><!-- see README for credits -->
        <I>Relaunched by Johnny_3_Tears<br>
        ww2game-1.j3t-games.com from 2023+
      </P><BR>


</FONT></CENTER>
<?php
$ip = $_SERVER['REMOTE_ADDR'];
$time = time() - (60 * 60 * 24);
include ('logger.php');
?>
