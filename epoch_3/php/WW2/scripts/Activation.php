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

class Activation extends BaseClass {
	public
		$id = 0,
		$username   = '',
		$email      = '',
		$password   = '',
		$nation     = 0,
		$IP         = '',
		$success    = 0,
		$userId     = 0,
		$referrerId = 0,
		$time       = 0;

	public function
	getByEmail($email) { global $db;
		$email = mysqli_real_escape_string($db, $email);
		$r = mysqli_query($db, "SELECT * FROM Activation WHERE email = \"$email\" LIMIT 1") or die(mysqli_error($db));
		$a = mysqli_fetch_array($r, mysqli_ASSOC);
		if ($a['id']) {
			foreach ($a as $key => $value) {
				$this->$key = $value;
			}
		}
		return $this;
	}
	
	public static function
	getByUsernamePassword($username, $password, $md5 = 0) { global $db;
		$ret->id = false;
		$ret->success = 0;
		if ($md5) {
			$password = md5($password);
		}
		$l = strlen($username);
		
		if ($l >= 2 and $l <= 25) {
			$username = mysqli_real_escape_string($db, $username);

			$r = mysqli_query($db, "select * from Activation where username LIKE \"$username\" and password = \"$password\";") or die(mysqli_error($db));
			$ret = mysqli_fetch_object($r, 'Activation');
			if (!$ret) {
				$ret->id = false;
			}
			return $ret;
		}
		
		return $ret;
	}
	
	public static function
	getByUsernameEmailCount($username, $email) { global $db;
		$username = mysqli_real_escape_string($db, $username);
		$email = mysqli_real_escape_string($db, $email);
		$r = mysqli_query($db, "select count(*) as retCode from Activation where (username LIKE \"$username\" or email LIKE \"$email\") and success = 0") or die(mysqli_error($db));
		$ret = mysqli_fetch_object($r);
		return $ret->retCode;
	}
	
	/* Tricky function
		Have to check to see if OTHER people have the username or email and not me
	*/
	public static function
	checkUsernameEmailAndNotMe($userId, $username, $email) { global $db;
		$username = mysqli_real_escape_string($db, $username);
		$email = mysqli_real_escape_string($db, $email);
		$r = mysqli_query($db, "select count(*) as retCode from Activation where (username LIKE \"$username\" or email LIKE \"$email\") and userId != $userId") or die(mysqli_error($db));
		$ret = mysqli_fetch_object($r);
		return $ret->retCode;
	}
	
	public static function
	searchUsernameEmailIp($username, $email, $ip, $oa = 'AND') { global $db;
		$ret = array();
	
		$username = mysqli_real_escape_string($db, $username);
		$email    = mysqli_real_escape_string($db, $email);
		$ip       = mysqli_real_escape_string($db, $ip);
		
		$q = mysqli_query($db, "SELECT * FROM Activation WHERE username LIKE \"$username\" $oa email LIKE \"$email\" $oa ip LIKE \"$ip\" ORDER BY id asc") or die(mysqli_error($db));
		while ($r = mysqli_fetch_object($q, 'Activation')) {
			$ret[] = $r;
		}	
		
		return $ret;
	}
	
}
?>
