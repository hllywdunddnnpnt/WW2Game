-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2010 at 04:55 PM
-- Server version: 5.0.91
-- PHP Version: 5.2.6

--    World War II MMORPG
--    Copyright (C) 2009-2010 Richard Eames
--
--    This program is free software: you can redistribute it and/or modify
--    it under the terms of the GNU General Public License as published by
--    the Free Software Foundation, either version 3 of the License, or
--    (at your option) any later version.
--
--    This program is distributed in the hope that it will be useful,
--    but WITHOUT ANY WARRANTY; without even the implied warranty of
--    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
--    GNU General Public License for more details.
--
--    You should have received a copy of the GNU General Public License
--    along with this program.  If not, see <http://www.gnu.org/licenses/>.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ww2game_db`
--



-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL,
  `nation` tinyint(4) NOT NULL default '0',
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL default '',
  `key` varchar(32) NOT NULL default '',
  `gclick` tinyint(2) NOT NULL default '15',
  `commander` int(10) NOT NULL default '0',
  `active` int(1) NOT NULL default '0',
  `area` int(11) NOT NULL default '0',
  `dalevel` int(10) NOT NULL default '0',
  `salevel` int(10) NOT NULL default '0',
  `gold` bigint(15) NOT NULL default '0',
  `bank` bigint(10) unsigned NOT NULL default '0',
  `primary` tinyint(1) NOT NULL default '0',
  `attackturns` bigint(15) NOT NULL default '0',
  `up` bigint(15) unsigned NOT NULL default '0',
  `calevel` int(10) unsigned NOT NULL default '0',
  `ralevel` int(10) unsigned NOT NULL default '0',
  `maxofficers` smallint(2) NOT NULL default '5',
  `sasoldiers` bigint(15) NOT NULL default '0',
  `samercs` bigint(15) NOT NULL default '0',
  `dasoldiers` bigint(15) NOT NULL default '0',
  `damercs` bigint(15) NOT NULL default '0',
  `uu` bigint(15) unsigned NOT NULL default '0',
  `spies` bigint(15) unsigned NOT NULL default '0',
  `lastturntime` int(10) unsigned NOT NULL default '0',
  `vacation` int(11) NOT NULL default '0',
  `accepted` tinyint(1) NOT NULL default '0',
  `commandergold` bigint(15) NOT NULL default '0',
  `gameSkill` int(10) NOT NULL default '0',
  `specialforces` bigint(15) unsigned NOT NULL default '0',
  `bankper` int(10) NOT NULL default '10',
  `SA` bigint(15) unsigned NOT NULL default '0',
  `DA` bigint(15) unsigned NOT NULL default '0',
  `CA` bigint(15) unsigned NOT NULL default '0',
  `RA` bigint(15) unsigned NOT NULL default '0',
  `rank` int(10) NOT NULL default '0',
  `sarank` int(10) NOT NULL default '0',
  `darank` int(10) NOT NULL default '0',
  `carank` int(10) NOT NULL default '0',
  `rarank` int(10) NOT NULL default '0',
  `alliance` int(5) NOT NULL default '0',
  `hhlevel` int(10) NOT NULL default '0',
  `officerup` float NOT NULL default '0',
  `changenick` tinyint(4) NOT NULL default '0',
  `admin` int(10) NOT NULL default '0',
  `clicks` int(10) NOT NULL default '0',
  `supporter` smallint(5) NOT NULL default '0' COMMENT 'Number of dollars',
  `reason` varchar(255) NOT NULL default '',
  `clickall` tinyint(1) NOT NULL default '0',
  `bankimg` tinyint(1) NOT NULL default '1',
  `cheatcount` int(10) NOT NULL default '0',
  `status` varchar(50) NOT NULL default '',
  `numofficers` int(10) NOT NULL default '0',
  `irc` int(10) NOT NULL default '0',
  `ircstatus` varchar(40) NOT NULL default '',
  `ircnick` varchar(50) NOT NULL default '',
  `currentIP` varchar(30) default NULL,
  `unreadMsg` int(10) NOT NULL default '0',
  `msgCount` int(10) NOT NULL default '0',
  `aaccepted` tinyint(1) NOT NULL default '0',
  `referrer` int(10) NOT NULL default '0',
  `ircpass` varchar(30) NOT NULL default '',
  `minattack` bigint(15) NOT NULL default '0',
  `htmlColour` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `commander` (`commander`),
  KEY `alliance` (`alliance`),
  KEY `currentIP` (`currentIP`),
  KEY `referrer` (`referrer`),
  KEY `rank` (`rank`),
  KEY `area` (`area`),
  KEY `key` (`key`)
) ENGINE=MyISAM  PACK_KEYS=0  ;

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `Activation`
--

CREATE TABLE IF NOT EXISTS `Activation` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nation` tinyint(2) NOT NULL default '0',
  `IP` varchar(35) NOT NULL default '',
  `success` tinyint(4) NOT NULL default '0',
  `userId` int(10) NOT NULL default '0' COMMENT 'Link to the UserDetails table',
  `referrerId` int(11) NOT NULL default '0' COMMENT 'Link to referring player',
  `time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userName` (`username`,`password`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `Alliance`
--

CREATE TABLE IF NOT EXISTS `Alliance` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tag` varchar(8) NOT NULL default '0',
  `leaderId1` int(10) NOT NULL default '0',
  `leaderId2` int(10) NOT NULL default '0',
  `leaderId3` int(10) NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `creationdate` int(11) NOT NULL default '0',
  `status` tinyint(2) NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `irc` varchar(10) NOT NULL default '',
  `ircServer` varchar(255) NOT NULL default '',
  `message` varchar(255) NOT NULL default '',
  `UP` int(10) NOT NULL default '0',
  `gold` bigint(15) NOT NULL default '0',
  `donated` float NOT NULL default '0',
  `usedcash` float NOT NULL default '0',
  `tax` float NOT NULL default '0.01',
  `SA` float NOT NULL default '0',
  `DA` float NOT NULL default '0',
  `CA` float NOT NULL default '0',
  `RA` float NOT NULL default '0',
  `news` text NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `password` (`password`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `AllianceBan`
--

CREATE TABLE IF NOT EXISTS `AllianceBan` (
  `id` int(11) NOT NULL auto_increment,
  `allianceId` int(11) NOT NULL default '0',
  `targetId` int(11) NOT NULL default '0',
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `allianceId` (`allianceId`,`targetId`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `AllianceShout`
--

CREATE TABLE IF NOT EXISTS `AllianceShout` (
  `id` int(11) NOT NULL auto_increment,
  `allianceId` int(11) NOT NULL default '0',
  `userId` int(11) NOT NULL default '0',
  `date` int(11) NOT NULL default '0',
  `message` varchar(160) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `allianceId` (`allianceId`),
  KEY `date` (`date`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `BattleLog`
--

CREATE TABLE IF NOT EXISTS `BattleLog` (
  `id` int(11) NOT NULL auto_increment,
  `attackerId` int(11) NOT NULL default '0',
  `targetId` int(11) NOT NULL default '0',
  `attackType` int(11) NOT NULL default '0',
  `time` int(10) NOT NULL default '0',
  `isSuccess` tinyint(1) NOT NULL default '0',
  `attackerStrength` bigint(15) unsigned NOT NULL default '0',
  `targetStrength` bigint(15) unsigned NOT NULL default '0',
  `attackerStrikePercentage` smallint(4) NOT NULL default '0',
  `targetDefensePercentage` smallint(4) NOT NULL default '0',
  `attackerLosses` bigint(15) NOT NULL default '0',
  `targetLosses` bigint(15) NOT NULL default '0',
  `attackerDamage` bigint(15) NOT NULL default '0',
  `targetDamage` bigint(15) NOT NULL default '0',
  `satrained` bigint(15) NOT NULL default '0',
  `samercs` bigint(15) NOT NULL default '0',
  `sauntrained` bigint(15) NOT NULL default '0',
  `datrained` bigint(15) NOT NULL default '0',
  `damercs` bigint(15) NOT NULL default '0',
  `dauntrained` bigint(15) NOT NULL default '0',
  `satrainednw` bigint(15) NOT NULL default '0',
  `samercsnw` bigint(15) NOT NULL default '0',
  `sauntrainednw` bigint(15) NOT NULL default '0',
  `datrainednw` bigint(15) NOT NULL default '0',
  `damercsnw` bigint(15) NOT NULL default '0',
  `dauntrainednw` bigint(15) NOT NULL default '0',
  `goldStolen` bigint(15) NOT NULL default '0',
  `percentStolen` smallint(4) NOT NULL default '0',
  `attackerExp` int(11) NOT NULL default '0',
  `targetExp` int(11) NOT NULL default '0',
  `attackerHostages` bigint(15) NOT NULL default '0',
  `targetHostages` bigint(15) NOT NULL default '0',
  `attackerRA` bigint(15) NOT NULL default '0',
  `targetRA` bigint(15) NOT NULL default '0',
  `attackerRAPercentage` int(11) NOT NULL default '0',
  `targetRAPercentage` int(11) NOT NULL default '0',
  `RADamage` bigint(15) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `attackerId` (`attackerId`),
  KEY `targetId` (`targetId`),
  KEY `time` (`time`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE IF NOT EXISTS `Contact` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `type` int(11) NOT NULL default '0',
  `text` text NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  `done` int(11) NOT NULL default '0',
  `reference` int(11) NOT NULL default '0',
  `replied` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  ;

-- --------------------------------------------------------

--
-- Table structure for table `Ignore`
--

CREATE TABLE IF NOT EXISTS `Ignore` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL default '0',
  `targetId` int(11) NOT NULL default '0',
  `note` varchar(255) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `userId` (`userId`,`targetId`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `IP`
--

CREATE TABLE IF NOT EXISTS `IP` (
  `id` int(20) NOT NULL auto_increment,
  `IP` varchar(20) NOT NULL default '',
  `uid` int(10) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `ip` (`IP`),
  KEY `userID` (`uid`),
  KEY `time` (`time`),
  KEY `IP_2` (`IP`,`uid`)
) ENGINE=InnoDB  PACK_KEYS=0  ;

-- --------------------------------------------------------

--
-- Table structure for table `Mercenaries`
--

CREATE TABLE IF NOT EXISTS `Mercenaries` (
  `attackSpecCount` int(11) NOT NULL default '0',
  `defSpecCount` int(11) NOT NULL default '0',
  `untrainedCount` int(11) NOT NULL default '0',
  `lastturntime` int(11) NOT NULL default '0',
  `avgarmy` bigint(15) NOT NULL default '0',
  `avgtbg` bigint(15) NOT NULL default '0',
  `avgup` bigint(15) NOT NULL default '0',
  `avgsa` bigint(15) NOT NULL default '0',
  `avgda` bigint(15) NOT NULL default '0',
  `avgra` bigint(15) NOT NULL default '0',
  `avgca` bigint(15) NOT NULL default '0',
  `avghit` bigint(15) NOT NULL default '0'
) ENGINE=MyISAM;

-- 
-- Add the single needed row, all values set to default except turntime
--
INSERT INTO `Mercenaries` (`lastturntime`) VALUES (UNIX_TIMESTAMP());

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(10) NOT NULL auto_increment,
  `targetId` int(10) NOT NULL default '0',
  `senderId` int(10) NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `text` text NOT NULL default '',
  `targetStatus` tinyint(1) NOT NULL default '1',
  `senderStatus` tinyint(1) NOT NULL default '0',
  `date` int(10) NOT NULL default '0',
  `age` int(11) NOT NULL default '0',
  `fromadmin` tinyint(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `targetId` (`targetId`),
  KEY `subject_2` (`subject`),
  KEY `age` (`age`),
  FULLTEXT KEY `subject` (`subject`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  PACK_KEYS=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `Report`
--

CREATE TABLE IF NOT EXISTS `Report` (
  `id` int(10) NOT NULL auto_increment,
  `userId` int(10) NOT NULL default '0' COMMENT 'the user who reported it',
  `targetId` int(10) NOT NULL default '0' COMMENT 'the suspected user',
  `type` smallint(3) NOT NULL default '0' COMMENT 'type ',
  `time` int(10) NOT NULL default '0',
  `info` varchar(160) NOT NULL default '' COMMENT 'reason why the suspect was reported.',
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`,`targetId`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `SpyLog`
--

CREATE TABLE IF NOT EXISTS `SpyLog` (
  `id` int(10) NOT NULL auto_increment,
  `attackerId` int(10) NOT NULL default '0',
  `targetId` int(10) NOT NULL default '0',
  `attackerStrength` bigint(15) NOT NULL default '0',
  `targetStrength` bigint(15) NOT NULL default '0',
  `sasoldiers` bigint(15) NOT NULL default '',
  `samercs` bigint(15) NOT NULL default '',
  `dasoldiers` bigint(15) NOT NULL default '',
  `damercs` bigint(15) NOT NULL default '',
  `uu` bigint(15) NOT NULL default '0',
  `SA` bigint(15) NOT NULL default '0',
  `DA` bigint(15) NOT NULL default '0',
  `calevel` bigint(15) NOT NULL default '0',
  `targetSpies` bigint(15) NOT NULL default '0',
  `salevel` bigint(15) NOT NULL default '',
  `dalevel` bigint(15) NOT NULL default '0',
  `attackTurns` int(11) NOT NULL default '',
  `unitProduction` int(11) NOT NULL default '',
  `weapons` varchar(255) NOT NULL default '',
  `types` varchar(255) NOT NULL default '',
  `types2` varchar(255) NOT NULL default '',
  `quantities` varchar(255) NOT NULL default '',
  `strengths` varchar(255) NOT NULL default '',
  `allStrengths` varchar(255) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `spies` bigint(15) NOT NULL default '0',
  `isSuccess` tinyint(1) NOT NULL default '0',
  `sf` varchar(11) NOT NULL default '0',
  `ralevel` varchar(11) NOT NULL default '0',
  `hhlevel` varchar(11) NOT NULL default '',
  `gold` bigint(21) NOT NULL default '0',
  `weapontype` tinyint(4) NOT NULL default '0',
  `type` tinyint(4) NOT NULL default '0',
  `weaponamount` bigint(15) NOT NULL default '0',
  `hostages` bigint(15) NOT NULL default '0',
  `weapontype2` tinyint(4) NOT NULL default '0',
  `goldStolen` bigint(21) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userID` (`attackerId`),
  KEY `toUserID` (`targetId`),
  KEY `time` (`time`)
) ENGINE=MyISAM  PACK_KEYS=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
  `id` int(10) NOT NULL auto_increment,
  `time` int(10) NOT NULL default '0',
  `amount` float NOT NULL default '0',
  `userId` int(10) NOT NULL default '0',
  `forId` int(10) NOT NULL default '0',
  `isAlliance` tinyint(1) NOT NULL default '0',
  `token` varchar(50) NOT NULL default '',
  `timestamp` varchar(50) NOT NULL default '',
  `correlationId` varchar(50) NOT NULL default '',
  `ack` varchar(25) NOT NULL default '',
  `version` varchar(25) NOT NULL default '',
  `build` varchar(25) NOT NULL default '',
  `part1Success` tinyint(1) NOT NULL default '0',
  `part4Success` tinyint(1) NOT NULL, default '0'
  `payerId` varchar(25) NOT NULL default '0',
  `transactionId` varchar(50) NOT NULL default '',
  `transactionType` varchar(50) NOT NULL default '',
  `paymentType` varchar(50) NOT NULL default '',
  `orderTime` varchar(50) NOT NULL default '',
  `fee` float NOT NULL default '0',
  `tax` float NOT NULL default '0',
  `currencyCode` varchar(5) NOT NULL default '',
  `paymentStatus` varchar(50) NOT NULL default '',
  `pendingReason` varchar(255) NOT NULL default '',
  `reasonCode` varchar(50) NOT NULL default '',
  `errorInfo` text NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM ;

--
-- Table structure for table `Weapon`
--

CREATE TABLE IF NOT EXISTS `Weapon` (
  `id` int(11) NOT NULL auto_increment,
  `weaponId` int(11) NOT NULL default '0',
  `weaponStrength` int(11) NOT NULL default '0',
  `weaponCount` bigint(15) NOT NULL default '0',
  `isAttack` int(11) NOT NULL default '0',
  `userId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userID` (`userId`)
) ENGINE=MyISAM  PACK_KEYS=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `TFF`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`ww2game`@`localhost` SQL SECURITY DEFINER VIEW 
`ww2game_db`.`TFF` AS 
	select 
		`ww3game_db`.`User`.`id` AS `id`,
		`ww3game_db`.`User`.`username` AS `username`,
		`ww2game_db`.`User`.`up` AS `up`,
		`ww2game_db`.`User`.`officerup` AS `officerup`,
		(`ww2game_db`.`User`.`up` + `ww2game_db`.`User`.`officerup`) AS `totalup`,
		(
			(
				(
					(
						(
							(`ww2game_db`.`User`.`uu` + `ww2game_db`.`User`.`samercs`) + 
							`ww2game_db`.`User`.`damercs`
						) + 
						`ww2game_db`.`User`.`spies`
					) + 
				`ww2game_db`.`User`.`specialforces`
			) + `ww2game_db`.`User`.`sasoldiers`
		) + `ww2game_db`.`User`.`dasoldiers`) AS `tff`,
		`ww2game_db`.`User`.`uu` AS `uu`,
		`ww2game_db`.`User`.`sasoldiers` AS `sasoldiers`,
		`ww2game_db`.`User`.`samercs` AS `samercs`,
		`ww2game_db`.`User`.`dasoldiers` AS `dasoldiers`,
		`ww2game_db`.`User`.`damercs` AS `damercs`,
		`ww2game_db`.`User`.`spies` AS `spies`,
		`ww2game_db`.`User`.`specialforces` AS `specialforces` 
	from 
		`ww2game_db`.`User` 
	where 
		(`ww2game_db`.`User`.`active` = 1) 
	order by 
		((((((`ww2game_db`.`User`.`uu` + `ww2game_db`.`User`.`samercs`) + `ww2game_db`.`User`.`damercs`) + `ww2game_db`.`User`.`spies`) + `ww2game_db`.`User`.`specialforces`) + `ww2game_db`.`User`.`sasoldiers`) + `ww2game_db`.`User`.`dasoldiers`) desc;


INSERT INTO `UserDetails`(`ID`, `userName`, `race`, `email`, `password`, `gold`, `attackturns`, `uu`) VALUES 
(null, 'Johnny_3_Tears', '0', 'night_train_247@hotmail.com', '9ba36afc4e560bf811caefc0c7fddddf', '100000000', '100', '100000'),
(null, 'FortRoyal', '1', 'fort-royal@hotmail.com', '9ba36afc4e560bf811caefc0c7fddddf', '100000000', '100', '100000'),
(null, 'Vegard', '3', 'vegardgf@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '100000000', '100', '100000');