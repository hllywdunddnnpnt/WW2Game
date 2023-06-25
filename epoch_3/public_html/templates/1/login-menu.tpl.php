
<!--

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

-->
					<!-- Begin login-menu -->
					<div id="login-form">
						<div class="menu-age high">Age <?= $conf['age'] ?></div>
						<form method="post" action="index.php">
							<ul class="ul-login-menu">
								<li style="margin-bottom: 4px;"><label for="login-username">Username:</label></li>
								<li style="margin-bottom: 8px;">
									<input type="text" id="login-username" name="login-username" style="width: 145px;" />
								</li>
								<li style="margin-bottom: 4px;"><label for="login-password">Password:</label></li>
								<li style="margin-bottom: 15px;">
									<input type="password" id="login-password" name="login-password" style="width: 145px;" />
								</li>
								<li><input type="submit" id="login-submit" name="login-submit" value="Login" style="width: 80px; padding: 5px 6px; margin-left: 30px;" />
								<li>&nbsp;</li>
								<li class="dot"><a href="register.php" alt="Register for your free world war 2 account" title="Register for your free world war 2 account">Register</a><li>
								<li class="dot"><a href="forgotpass.php" alt="Forgot your password? We'll send you a new one for your WW2 account." title="Forgot your password? We'll send you a new one for your WW2 account.">Resend Password</a></li>
							</ul>
						</form>
					</div>
					<!-- End login-menu -->
