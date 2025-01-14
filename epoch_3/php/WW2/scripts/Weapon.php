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

class Weapon extends BaseClass{
	public
		$id = 0,
		$weaponId = 0,
		$weaponStrength = 0,
		$weaponCount = 0,
		$isAttack = 0,
		$userId = 0;

	public function
	create() {
		if (!$this->weaponCount or $this->weaponCount <= 0) {
			return 0;
		}
		return parent::create();
	}

	public function
	getName($user = null) {
		global $conf;
		$type = $this->isAttack ? 1 : 0;
		return $conf['names']['weapons'][$type][$this->weaponId];
	}

	public function
	getFullStrength() {
		global $conf;
		return $conf['weapon' . $this->weaponId . 'strength'];
	}

	public function
	getPP() {
		global $conf;
		return $conf['weapon' . $this->weaponId . 'pp'];
	}

	public function
	getPrice() {
		global $conf;
		return $conf['weapon' . $this->weaponId . 'price'];
	}

	public function
	getRepairPerPoint() {
		return $this->getPP() * $this->weaponCount;
	}

	public function
	getDamage() {
		return $this->getFullStrength() - $this->weaponStrength;
	}

	public function
	getSellCost($user, $n = 1) {
		$cost = $n * round($this->getPrice() * (($this->weaponStrength / $this->getFullStrength()) - 0.2));
		if ($cost > 0) {
			return $cost;
		}
		// Dropped below 20%, it's scrap sell
		return 0;
	}

	public static function
	getUserAttackWeapons($userId, $order = 'weaponStrength') { global $db;
		$ret = array();
		if (!$userId) {
			return $ret;	
		}
		
		$q = mysqli_query($db, "SELECT * FROM Weapon WHERE userId = $userId AND isAttack = 1 AND weaponStrength > 0 and weaponCount > 0 ORDER BY $order DESC") or die(mysqli_error($db));
		while ($w = mysqli_fetch_object($q, 'Weapon')) {
			$ret[] = $w;
		}
		
		return $ret;
	}

	public static function
	getUserDefenseWeapons($userId, $order = 'weaponStrength') { global $db;
		$ret = array();
		if (!$userId) {
			return $ret;	
		}
		
		$q = mysqli_query($db, "SELECT * FROM Weapon WHERE userId = $userId AND isAttack = 0 AND weaponStrength > 0 and weaponCount > 0 ORDER BY $order DESC") or die(mysqli_error($db));
		while ($w = mysqli_fetch_object($q, 'Weapon')) {
			$ret[] = $w;
		}
		
		return $ret;
	}

	public static function
	getUserAttackWeaponsCount($userId) { global $db;
		$ret = 0;
		if (!$userId) {
			return $ret;	
		}
		
		$q = mysqli_query($db, "SELECT sum(weaponCount) as retCode FROM Weapon WHERE userId = $userId AND isAttack = 1") or die(mysqli_error($db));
		$ret = mysqli_fetch_object($q);
		
		return $ret->retCode;
	}

	public static function
	getUserDefenseWeaponsCount($userId) { global $db;
		$ret = 0;
		if (!$userId) {
			return $ret;	
		}
		
		$q = mysqli_query($db, "SELECT sum(weaponCount) as retCode FROM Weapon WHERE userId = $userId AND isAttack = 0") or die(mysqli_error($db));
		$ret = mysqli_fetch_object($q);
		
		return $ret->retCode;
	}

	public static function
	getStrengthRatio($userId, $isAttack) { global $db;
		$isAttack = $isAttack ? 1 : 0;
		if (!$userId) {
			return 0;
		}
		$ret = (Object) [];
		
		$q = mysqli_query($db, "
			SELECT
				sum(weaponCount * weaponStrength) as ratio,
				sum(weaponCount) as total
			FROM
				Weapon
			WHERE
				userId = $userId AND
				isAttack = $isAttack
		") or die(mysqli_error($db));

		$r = mysqli_fetch_object($q);

		if ($r)
			{
				$ret->ratio = $r->ratio / ($r->total <= 0 ? 1 : $r->total);
				$ret->total = $r->total;
			}
	

		return $ret;
	}
	
	public static function
	queryWeapon($userId, $isAttack, $weaponType) { global $db;
		$ret = null;
		$q = mysqli_query($db, "
			SELECT 
				* 
			FROM 
				Weapon 
			WHERE 
				userId   = $userId AND 
				isAttack = $isAttack AND
				weaponId = $weaponType
		") or die(mysqli_error($db));
		
		if ($r = mysqli_fetch_object($q, 'Weapon')) {
			$ret = $r;
		}
		
		return $ret;
	}
	
	public static function
	deleteAllUserWeapons($userId) { global $db;
		mysqli_query($db, "DELETE FROM Weapon WHERE userId = $userId") or die(mysqli_error($db));
	}
	
	public static function
	cleanupWeapons() {
		global $conf, $db;
		mysqli_query($db, "DELETE FROM Weapon WHERE weaponStrength <= 0") or die(mysqli_error($db));
		
		for ($i = 0; $i < 5; $i++) {
			$max_strength = $conf["weapon{$i}strength"];
			mysqli_query($db, "DELETE FROM Weapon WHERE weaponId = $i and weaponStrength > $max_strength and weaponStrength > 0") or die(mysqli_error($db));
		}
	}
}
?>
