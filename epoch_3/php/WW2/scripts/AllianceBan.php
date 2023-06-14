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

require_once('scripts/Alliance.php');

class AllianceBan extends BaseClass {
	public
		$id         = 0,
		$allianceId = 0,
		$targetId   = 0,
		$date       = 0;

	//statics
	public static function
	getByPair(Alliance $a, User $target) { global $db;
		$ret = null;
		
		$q = mysqli_query($db, "SELECT * FROM `AllianceBan` WHERE allianceId = $a->id and targetId = $target->id") or die(mysqli_error($db));
		$r = mysqli_fetch_object($q, 'AllianceBan');
		if ($r) {
			$ret = $r;
		}
		
		return $ret;
	}
	
	public static function
	isBlocked(Alliance $a, User $target) { global $db;
		$ret = false;
		
		$q = mysqli_query($db, "SELECT count(*) as retCode FROM `AllianceBan` WHERE allianceId = $a->id and targetId = $target->id") or die(mysqli_error($db));
		$r = mysqli_fetch_object($q);
		if ($r->retCode > 0) {
			$ret = true;
		}	
		
		return $ret;
	}	
	

	public static function
	getAll(Alliance $a) { global $db;
		$ret = array();
		
		$q = mysqli_query($db, "SELECT * FROM `AllianceBan` WHERE allianceId = $a->id ORDER BY id DESC") or die(mysqli_error($db));
		while ($r = mysqli_fetch_object($q, 'AllianceBan')) {
			$ret[] = $r;
		}
		
		return $ret;
	}
	
	public static function
	getAllianceIdsWhoBlockedUser(User $u) { global $db;
		$ret = array();
		
		$q = mysqli_query($db, "SELECT allianceId FROM `AllianceBan` WHERE targetId = $u->id ORDER BY id DESC") or die(mysqli_error($db));
		while ($r = mysqli_fetch_object($q)) {
			$ret[$r->allianceId] = true;
		}
		
		return $ret;
	}
	
	public static function
	removeIds(Alliance $a, array $ids) { global $db;
		if (!count($ids)) return;
		
		$ids = implode(',', $ids);
		mysqli_query($db, "DELETE FROM `AllianceBan` WHERE allianceId = $a->id and id in ($ids)") or die(mysqli_error($db));
	}
}
?>
