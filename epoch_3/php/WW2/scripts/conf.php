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

/*
$envpath = ini_get('ENVPATH');
if (isset($incron) && $incron === true) require_once(HOME.'public_html/env/env.php');
else if ($envpath) require_once($envpath . '/env.php');
else require_once('env/env.php');*/
//require_once((isset($incron) && $incron === true) ? 'env.php' : 'env.php');
require_once('env.php');


$min  = 60;
$hour = $min*60;
$day  = $hour*24;
$week = $day*7;
 
$time    = time();

$allow_bonuses = false;
$game_offline  = false;
$allow_vacation = false;

if (time() > ($endtime - (2 * $week))) {
	$allow_bonuses = true;
}

if (time() < ($endtime - (5 * $day))) {

	$allow_vacation = true;
}

$diff       = $endtime - $time;
if ($time > $endtime) { 
	$game_offline = true;
}

$d = duration($diff);

$resetA = "Resets in: $d";
$announce = "";

$conf_announcement = $announce  . ' ' .  $resetA;

$conf['age'] = $_AGE;
 
// If changing these, update User
$conf['start-gold'           ] = 1000000;
$conf['start-attackturns'    ] = 50;
$conf['start-uu'             ] = 0;
$conf['start-sasoldiers'     ] = 75;
$conf['start-dasoldiers'     ] = 75;

$conf['officers-per-page'    ] = 5;
$conf['max-officers'         ] = 15;
$conf['users-per-page'       ] = 30;
$conf['attacks-per-page'     ] = 10;
$conf['max-attacks'          ] = 10;
$conf['max-attacks-secs'     ] = 43200; // (60sec/min * 60min/hour * 12hour) = 43200 seconds
$conf['spying-cost'          ] = 2000;
$conf['attackturn-cap'       ] = 1000;
$conf['theft-cost'           ] = 3;
$conf['max-theft'            ] = 10;
$conf['max-theft-secs'       ] = 3600; // (60sec/min * 60min/hour * 1hour) = 3600 seconds
$conf['theft-magic-ratio'    ] = 130; // Need 30% more CA
$conf['theft-magic-ratio-max'] = 170; // and less than 70% more
$conf['recruit-seconds'      ] = 86400;  // 24hours
$conf['recruit-soldiers'     ] = 5;
$conf['max-recruit'          ] = 25;

$conf['max-alliance-shouts'  ] = 30;

$conf["sitename"] = "World War II: A New Dawn";
$conf["users_per_page"]=30;
$conf["users_per_page_on_attack_log"]=10;
$conf["mercenaries_per_turn"] = 400;
$conf["days_to_hold_logs"]=30; //For Battle Logs
$conf["ips_to_hold_per_user"]=10;

$conf['area-count'] = 3;
$conf['area'] = array (
	1 => array(
		'name'       => 'Europe',
		'short-name' => 'E',
		'size'       => 90,
	),
	2 => array(
		'name'       => 'Africa',
		'short-name' => 'A',
		'size'       => 240
	),
	3 => array(
		'name'       => 'Graveyard',
		'short-name' => 'G',
		'size'       => 10000
	)
);


/*usa, uk,jap,german,ussr*/


$conf['gps'] = array(
	20, // 10 %
	20,
	20,
	20,
	20
);

$race_bonuses = [
	/* USA */ [
		"offense" => 0,
		"defensive" => 10,
		"covert" => 5,
		"retaliation" => 25,
	],
	/* UK */ [
		"offense" => 5,
		"defensive" => 25,
		"covert" => 10,
		"retaliation" => 0,
	],
	/* Japan */ [
		"offense" => 10,
		"defensive" => 0,
		"covert" => 25,
		"retaliation" => 5,
	],
	/* Germany */ [
		"offense" => 25,
		"defensive" => 5,
		"covert" => 0,
		"retaliation" => 10,
	],
	/* USSR */ [
		"offense" => 10,
		"defensive" => 10,
		"covert" => 10,
		"retaliation" => 10,
	],
];

// Offensive Bonus for each race
$conf['sabonus0'] = $race_bonuses[0]["offense"] / 100;
$conf['sabonus1'] = $race_bonuses[1]["offense"] / 100;
$conf['sabonus2'] = $race_bonuses[2]["offense"] / 100;
$conf['sabonus3'] = $race_bonuses[3]["offense"] / 100;
$conf['sabonus4'] = $race_bonuses[4]["offense"] / 100;

// Defensive Bonus for each race
$conf['dabonus0'] = $race_bonuses[0]["defensive"] / 100;
$conf['dabonus1'] = $race_bonuses[1]["defensive"] / 100;
$conf['dabonus2'] = $race_bonuses[2]["defensive"] / 100;
$conf['dabonus3'] = $race_bonuses[3]["defensive"] / 100;
$conf['dabonus4'] = $race_bonuses[4]["defensive"] / 100;

// Covert Bonus for each race
$conf['cabonus0'] = $race_bonuses[0]["covert"] / 100;
$conf['cabonus1'] = $race_bonuses[1]["covert"] / 100;
$conf['cabonus2'] = $race_bonuses[2]["covert"] / 100;
$conf['cabonus3'] = $race_bonuses[3]["covert"] / 100;
$conf['cabonus4'] = $race_bonuses[4]["covert"] / 100;

// Retaliation Bonus for each race
$conf['rabonus0'] = $race_bonuses[0]["retaliation"] / 100;
$conf['rabonus1'] = $race_bonuses[1]["retaliation"] / 100;
$conf['rabonus2'] = $race_bonuses[2]["retaliation"] / 100;
$conf['rabonus3'] = $race_bonuses[3]["retaliation"] / 100;
$conf['rabonus4'] = $race_bonuses[4]["retaliation"] / 100;

$conf['cost'] = array(
	'sasoldier'     => 5000,
	'samerc'        => 10000,
	'damerc'        => 10000,
	'dasoldier'     => 5000,
	'spy'           => 3500,
	'specialforces' => 4000,
	'upgrades'      => array(
		0 => 0,
		1 => 10000,
		2 => 1000000,
		3 => 10000000,
		4 => 100000000,
	),
);

$conf['names'] = array(
	'upgrades' => array(
		0 => array (
			0 => 'None - Camouflage',
			1 => '1 - Trench',
			2 => '2 - Flack Jacket',
			3 => '3 - Anti-Tank Gun',
			4 => '4 - Flack Cannon',
		),
		1 => array (
			0 => 'None - Revolver',
			1 => '1 - Automatic Rifle',
			2 => '2 - Machine Gun',
			3 => '3 - Tank',
			4 => '4 - Plane',
		)
	),
	'weapons' => array(
		0 => array (
			0 => 'Camouflaged Uniforms',
			1 => 'Trenches',
			2 => 'Flack Jackets',
			3 => 'Anti-Tank Guns',
			4 => 'Flack Cannons',
		),
		1 => array (
			0 => 'Revolvers',
			1 => 'Automatic Rifles',
			2 => 'Machine Guns',
			3 => 'Tanks',
			4 => 'Planes',
		)
	),
);

$conf['strength'] = array(
	'sasoldier'    => 20,
	'samerc'       => 50,
	'dasoldier'    => 20,
	'damerc'       => 50,
	'untrained'    => 4
);

$conf['bonuses'] = [
	"offense" => "@% Attack",
	"defense" => "@% Defense",
	"covert" => "@% Covert",
	"retaliation" => "@% Retaliation",
];

$conf['race'] = [
	[
		'name' => "USA",
		'alias' => "Americans",
		'full_name' => "United States",
		'bonuses' => [
			"offense" => $conf['sabonus0'],
			"defense" => $conf['dabonus0'],
			"covert" => $conf['cabonus0'],
			"retaliation" => $conf['rabonus0'],
		],
		'img' => "templates/1/images/americans.gif",
		'desc' => "Gather your troops to fight the coming enemy!",
		'side' => 0,
		'side_name' => "The Allies",
		'max-dalevel' => 4,
		'max-salevel'  => 4,
	],[
		'name' => "UK",
		'alias' => "Britians",
		'full_name' => "United Kingdom",
		'bonuses' => [
			"offense" => $conf['sabonus1'],
			"defense" => $conf['dabonus1'],
			"covert" => $conf['cabonus1'],
			"retaliation" => $conf['rabonus1'],
		],
		'img' => "templates/1/images/britains.gif",
		'desc' => "Come to the aid of your allies and destroy your enemies!",
		'side' => 0,
		'side_name' => "The Allies",
		'max-dalevel' => 4,
		'max-salevel'  => 4,
	],[
		'name' => "Japan",
		'alias' => "Japanese",
		'full_name' => "Japan",
		'bonuses' => [
			"offense" => $conf['sabonus2'],
			"defense" => $conf['dabonus2'],
			"covert" => $conf['cabonus2'],
			"retaliation" => $conf['rabonus2'],
		],
		'img' => "templates/1/images/japanese.gif",
		'desc' => "Harness your strength and Kamikaze for your people!",
		'side' => 1,
		'side_name' => "The Axis",
		'max-dalevel' => 4,
		'max-salevel'  => 4,
	],[
		'name' => "Germany",
		'alias' => "Germans",
		'full_name' => "Germany",
		'bonuses' => [
			"offense" => $conf['sabonus3'],
			"defense" => $conf['dabonus3'],
			"covert" => $conf['cabonus3'],
			"retaliation" => $conf['rabonus3'],
		],
		'img' => "templates/1/images/german.gif",
		'desc' => "Use your Blitzkrieg to spread evil throughout the land!",
		'side' => 1,
		'side_name' => "The Axis",
		'max-dalevel' => 4,
		'max-salevel'  => 4,
	],[
		'name' => "USSR",
		'alias' => "Soviets",
		'full_name' => "Soviet Union",
		'bonuses' => [
			"offense" => $conf['sabonus4'],
			"defense" => $conf['dabonus4'],
			"covert" => $conf['cabonus4'],
			"retaliation" => $conf['rabonus4'],
		],
		'img' => "templates/1/images/german.gif",
		'desc' => "Stand unitied and fight to take over the world!",
		'side' => 1,
		'side_name' => "The Axis",
		'max-dalevel' => 4,
		'max-salevel'  => 4,
	],
];

?>
