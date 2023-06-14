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

class Ignore extends BaseClass {
	public
		$id       = 0,
		$userId   = 0,
		$targetId = 0,
		$note     = '',
		$time     = 0;

	//statics
	public static function
	getByPair(User $u, User $target) { global $db;
		$ret = null;
		
		$q = mysqli_query($db, "SELECT * FROM `Ignore` WHERE userId = $u->id and targetId = $target->id") or die(mysqli_error($db));
		$r = mysqli_fetch_object($q, 'Ignore');
		if ($r) {
			$ret = $r;
		}
		
		return $ret;
	}
	
	public static function
	isBlocked(User $u, User $target) { global $db;
		$ret = false;
		
		$q = mysqli_query($db, "SELECT count(*) as retCode FROM `Ignore` WHERE userId = $u->id and targetId = $target->id") or die(mysqli_error($db));
		$r = mysqli_fetch_object($q);
		if ($r->retCode > 0) {
			$ret = true;
		}	
		
		return $ret;
	}	
	

	public static function
	getAll(User $u) { global $db;
		$ret = array();
		
		$q = mysqli_query($db, "SELECT * FROM `Ignore` WHERE userId = $u->id ORDER BY id DESC") or die(mysqli_error($db));
		while ($r = mysqli_fetch_object($q, 'Ignore')) {
			$ret[] = $r;
		}
		
		return $ret;
	}
	
	public static function
	getUserIdsWhoBlockedUser(User $u) { global $db;
		$ret = array();
		
		$q = mysqli_query($db, "SELECT userId FROM `Ignore` WHERE targetId = $u->id ORDER BY id DESC") or die(mysqli_error($db));
		while ($r = mysqli_fetch_object($q)) {
			$ret[$r->userId] = true;
		}
		
		return $ret;
	}
	
	public static function
	removeIds(User $u, array $ids) { global $db;
		if (!count($ids)) return;
		
		$ids = implode(',', $ids);
		mysqli_query($db, "DELETE FROM `Ignore` WHERE userId = $u->id and id in ($ids)") or die(mysqli_error($db));
	}
}
?>
