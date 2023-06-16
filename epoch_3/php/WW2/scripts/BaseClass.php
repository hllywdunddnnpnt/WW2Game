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

class BaseClass {

	public function
	create() { global $db;
		$sql = 'INSERT INTO `' . get_class($this) . '` set ';
		$values = array();
		foreach ((array)$this as $k => $value) {
			if ($k != 'id' and $k != '_cache' and !is_array($value)) {
				$value = mysqli_real_escape_string($db, $value);
				$values[] = "`$k` = \"$value\"";
			}
		}

		$sql .= implode(', ', $values);
		$q = mysqli_query($db, $sql) or die(mysqli_error($db));
		$this->id = mysqli_insert_id($db);
		return $this->id;
	}
		
	public function
	get($id) { global $db;
		$r = mysqli_query($db, 'SELECT * FROM `' . get_class($this) . "` WHERE id = $id LIMIT 1") or die(mysqli_error($db));
		$a = mysqli_fetch_assoc($r);
		if ($a) {
			foreach ($a as $key => $value) {
				$this->$key = $value;
			}
		}
	}
	
	public function
	save() { global $db;
		$sql = 'UPDATE `' . get_class($this) . '` SET ';
		$values = array();
		foreach ((array)$this as $k => $value) {
			if ($k != 'id' and $k != '_cache' and !is_array($value)) {
				$value = mysqli_real_escape_string($db, $value);
				$values[] = "`$k` = \"$value\"";
			}
		}

		$sql .= implode(', ', $values);
		$sql .= " where id =$this->id;";
		
		if ($this->id) {
			mysqli_query($db, $sql) or die(mysqli_error($db));
		}
	}
	
	public function
	delete() { global $db;
		if ($this->id) {
			mysqli_query($db, 'DELETE FROM `' . get_class($this) . "` WHERE id = $this->id LIMIT 1") or die(mysqli_error($db));
		}
	}
	
	
	public static function
	getAll($c) { global $db;
		$ret = array();
		$q = mysqli_query($db, 'SELECT * FROM `' . $c . "`") or die(mysqli_error($db));
		
		while ($r = mysqli_fetch_object($q, $c)) {
			$ret[] = $r;
		}
		
		return $ret;
	}
	
}
?>
