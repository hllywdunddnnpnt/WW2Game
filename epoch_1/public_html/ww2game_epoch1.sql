-- phpMyAdmin SQL Dump
-- version 3.3.3deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2010 at 08:38 PM
-- Server version: 5.1.48
-- PHP Version: 5.3.2-1ubuntu5



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ww2game_epoch1`
--

-- --------------------------------------------------------

--
-- Table structure for table `alliances`
--

CREATE TABLE IF NOT EXISTS `alliances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tag` varchar(8) NOT NULL DEFAULT '0',
  `leaderId1` int(11) NOT NULL DEFAULT '0',
  `leaderId2` int(11) NOT NULL DEFAULT '0',
  `leaderId3` int(11) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  `creationdate` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `irc` varchar(10) NOT NULL DEFAULT '',
  `ircServer` varchar(255) NOT NULL default '',
  `message` varchar(255) NOT NULL default '',
  `UP` int(11) NOT NULL DEFAULT '0',
  `gold` bigint(21) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL default '0',
  `donated` float NOT NULL default '0',
  `usedcash` float NOT NULL default '0',
  `tax` float NOT NULL DEFAULT '0.01',
  `SA` float NOT NULL DEFAULT '0',
  `DA` float NOT NULL DEFAULT '0',
  `CA` float NOT NULL DEFAULT '0',
  `RA` float NOT NULL DEFAULT '0',
  `news` text NOT NULL default '',
  `bunkers` int(11) NOT NULL default '0',
  PRIMARY KEY (`id`),
  KEY `password` (`password`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `AttackLog`
--

CREATE TABLE IF NOT EXISTS `AttackLog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL default '0',
  `toUserID` int(11) NOT NULL default '0',
  `attackturns` int(11) NOT NULL default '0',
  `attackStrength` bigint(15) NOT NULL default '0',
  `defStrength` bigint(15) NOT NULL default '0',
  `gold` bigint(21) NOT NULL default '0',
  `attackUsersKilled` bigint(15) NOT NULL default '0',
  `defUsersKilled` bigint(15) NOT NULL default '0',
  `attackTrained` bigint(15) NOT NULL default '0',
  `attackUnTrained` bigint(15) NOT NULL default '0',
  `defTrained` bigint(15) NOT NULL default '0',
  `defUnTrained` bigint(15) NOT NULL default '0',
  `attackWeapons` varchar(2048) NOT NULL default '',
  `defWeapons` varchar(2048) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `attackWeaponCount` bigint(15) NOT NULL default '0',
  `defWeaponCount` bigint(15) NOT NULL default '0',
  `pergold` int(11) NOT NULL default '0',
  `attackMercs` bigint(15) NOT NULL default '0',
  `defMercs` bigint(15) NOT NULL default '0',
  `defexp` int(11) NOT NULL default '0',
  `attexp` int(11) NOT NULL default '0',
  `attper` int(11) NOT NULL default '0',
  `defper` int(11) NOT NULL default '0',
  `userhost` int(11) NOT NULL default '0',
  `defuserhost` int(11) NOT NULL default '0',
  `type` int(11) NOT NULL default '0',
  `raeff` int(11) NOT NULL default '0',
  PRIMARY KEY (`ID`),
  KEY `type` (`type`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `IPs`
--

CREATE TABLE IF NOT EXISTS `IPs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL default '',
  `userID` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `log_A`
--

CREATE TABLE IF NOT EXISTS `log_A` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='Basic indexing for the logging system' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Mercenaries`
--

CREATE TABLE IF NOT EXISTS `Mercenaries` (
  `attackSpecCount` bigint(15) NOT NULL DEFAULT '0',
  `defSpecCount` bigint(15) NOT NULL DEFAULT '0',
  `untrainedCount` bigint(15) NOT NULL DEFAULT '0',
  `lastturntime` int(11) NOT NULL DEFAULT '0',
  `avgarmy` bigint(15) NOT NULL DEFAULT '0',
  `avgtbg` bigint(15) NOT NULL DEFAULT '0',
  `avgup` bigint(15) NOT NULL DEFAULT '0',
  `avgsa` bigint(15) NOT NULL DEFAULT '0',
  `avgda` bigint(15) NOT NULL DEFAULT '0',
  `avgra` bigint(15) NOT NULL DEFAULT '0',
  `avgca` bigint(15) NOT NULL DEFAULT '0',
  `avghit` bigint(15) NOT NULL default '0'
) ENGINE=MyISAM;

INSERT INTO `Mercenaries` (`lastturntime`) VALUES (UNIX_TIMESTAMP());

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fromID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL default '',
  `text` text NOT NULL default '',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `senderStatus` tinyint(1) NOT NULL default '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `age` int(11) NOT NULL default '0',
  `fromadmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `targetId` (`fromID`),
  KEY `subject_2` (`subject`),
  KEY `age` (`age`),
  FULLTEXT KEY `subject` (`subject`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `toID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL default '',
  `text` text NOT NULL default '',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `senderStatus` tinyint(1) NOT NULL default '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `age` int(11) NOT NULL default '0',
  `fromadmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `targetId` (`toID`),
  KEY `subject_2` (`subject`),
  KEY `age` (`age`),
  FULLTEXT KEY `subject` (`subject`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  PACK_KEYS=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `proxylist`
--

CREATE TABLE IF NOT EXISTS `proxylist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='List of IPs known to be proxy servers' ;

-- --------------------------------------------------------

--
-- Table structure for table `Ranks`
--

CREATE TABLE IF NOT EXISTS `Ranks` (
  `userID` int(11) NOT NULL default '0',
  `active` int(11) NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `rankfloat` float NOT NULL default '0',
  `sarank` int(11) NOT NULL default '0',
  `darank` int(11) NOT NULL default '0',
  `carank` int(11) NOT NULL default '0',
  `rarank` int(11) NOT NULL default '0',
  PRIMARY KEY (`userID`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `SpyLog`
--

CREATE TABLE IF NOT EXISTS `SpyLog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL default '0',
  `toUserID` int(11) NOT NULL default '0',
  `spyStrength` bigint(15) NOT NULL default '0',
  `spyDefStrength` bigint(15) NOT NULL default '0',
  `sasoldiers` bigint(15) NOT NULL default '0',
  `samercs` bigint(15) NOT NULL default '0',
  `dasoldiers` bigint(15) NOT NULL default '0',
  `damercs` bigint(15) NOT NULL default '0',
  `untrainedMerc` bigint(15) NOT NULL default '0',
  `uu` bigint(15) NOT NULL default '0',
  `strikeAction` bigint(15) NOT NULL default '0',
  `defenceAction` bigint(15) NOT NULL default '0',
  `covertSkill` int(11) NOT NULL default '0',
  `covertOperatives` bigint(15) NOT NULL default '0',
  `salevel` int(11) NOT NULL default '0',
  `attackTurns` int(11) NOT NULL default '0',
  `unitProduction` int(11) NOT NULL default '0',
  `weapons` varchar(1024) NOT NULL default '',
  `type` int(11) NOT NULL default '0',
  `types` varchar(1024) NOT NULL default '',
  `types2` varchar(1024) NOT NULL default '',
  `quantities` varchar(1024) NOT NULL default '',
  `strengths` varchar(1024) NOT NULL default '',
  `allStrengths` varchar(1024) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `spies` bigint(15) NOT NULL default '0',
  `isSuccess` int(11) NOT NULL default '0',
  `race` int(11) NOT NULL default '0',
  `arace` int(11) NOT NULL default '0',
  `sf` int(11) NOT NULL default '0',
  `sflevel` int(11) NOT NULL default '0',
  `hh` int(11) NOT NULL default '0',
  `gold` bigint(21) NOT NULL default '0',
  `weapontype` int(11) NOT NULL default '0',
  `weapontype2` int(11) NOT NULL default '0',
  `weaponamount` int(11) NOT NULL default '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM ;

-- --------------------------------------------------------

--
-- Table structure for table `UserDetails`
--

CREATE TABLE IF NOT EXISTS `UserDetails` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(25) NOT NULL,
  `race` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `gold` bigint(21) NOT NULL DEFAULT '0',
  `attackturns` int(11) NOT NULL DEFAULT '0',
  `bank` bigint(20) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `uu` int(11) NOT NULL DEFAULT '0',
  `up` int(11) NOT NULL DEFAULT '0',
  `sasoldiers` int(11) NOT NULL DEFAULT '0',
  `samercs` int(11) NOT NULL DEFAULT '0',
  `dasoldiers` int(11) NOT NULL DEFAULT '0',
  `damercs` int(11) NOT NULL DEFAULT '0',
  `spies` int(11) NOT NULL DEFAULT '0',
  `specialforces` int(11) NOT NULL DEFAULT '0',
  `scientists` int(11) NOT NULL DEFAULT '0',
  `salevel` int(11) NOT NULL DEFAULT '0',
  `dalevel` int(11) NOT NULL DEFAULT '0',
  `calevel` int(11) NOT NULL DEFAULT '0',
  `sflevel` int(11) NOT NULL DEFAULT '0',
  `hhlevel` int(11) NOT NULL DEFAULT '0',
  `nukelevel` int(11) NOT NULL DEFAULT '0',
  `bankper` int(11) NOT NULL DEFAULT '0',
  `bunkers` int(11) NOT NULL DEFAULT '0',
  `nukes` int(11) NOT NULL DEFAULT '0',
  `SA` bigint(20) NOT NULL DEFAULT '0',
  `DA` bigint(20) NOT NULL DEFAULT '0',
  `CA` bigint(20) NOT NULL DEFAULT '0',
  `RA` bigint(20) NOT NULL DEFAULT '0',
  `maxofficers` smallint(2) NOT NULL DEFAULT '5',
  `commander` int(11) NOT NULL DEFAULT '0',
  `accepted` int(11) NOT NULL DEFAULT '0',
  `lastturntime` int(11) unsigned NOT NULL DEFAULT '0',
  `clickall` int(11) NOT NULL DEFAULT '0',
  `gclick` int(11) NOT NULL DEFAULT '0',
  `bankimg` int(11) NOT NULL DEFAULT '0',
  `alliance` int(5) NOT NULL DEFAULT '0',
  `supporter` tinyint(2) NOT NULL DEFAULT '0',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `cheatcount` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '',
  `donatorgold` bigint(15) unsigned NOT NULL DEFAULT '0',
  `vaulttime` bigint(15) unsigned NOT NULL DEFAULT '0',
  `lastvault` bigint(15) unsigned NOT NULL DEFAULT '0',
  `numofficers` int(11) NOT NULL DEFAULT '0',
  `commandergold` int(11) NOT NULL DEFAULT '0',
  `officerup` int(11) NOT NULL DEFAULT '0',
  `offline` int(11) NOT NULL DEFAULT '0',
  `weapper` int(11) NOT NULL DEFAULT '0',
  `savings` bigint(15) NOT NULL DEFAULT '0',
  `aaccepted` tinyint(1) NOT NULL DEFAULT '0',
  `referrer` int(11) NOT NULL DEFAULT '0',
  `treasuryAttack` tinyint(1) NOT NULL DEFAULT '0',
  `donatorType` tinyint(2) NOT NULL DEFAULT '0',
  `isTop15` tinyint(2) NOT NULL DEFAULT '0',
  `gameSkill` int(5) NOT NULL DEFAULT '0',
  `goldRush` int(5) NOT NULL DEFAULT '0',
  `onlineTotal` int(5) NOT NULL DEFAULT '0',
  `gcCount` int(3) NOT NULL DEFAULT '0',
  `spyCredits` int(4) NOT NULL DEFAULT '0',
  `CrimeTicks` int(1) NOT NULL DEFAULT '0',
  `CrimeCommitted` int(1) NOT NULL DEFAULT '0',
  `CrimeCode` int(1) NOT NULL DEFAULT '0',
  `frozen` int(1) NOT NULL DEFAULT '0',
  `tc` int(4) NOT NULL DEFAULT '0',
  `vacation` int(11) NOT NULL DEFAULT '0',
  `graceday` int(1) NOT NULL DEFAULT '1',
  `globMercs` int(3) NOT NULL DEFAULT '5',
  `SpentGC` int(1) NOT NULL DEFAULT '1',
  `supportP1` int(1) NOT NULL DEFAULT '0',
  `supportP2` int(1) NOT NULL DEFAULT '0',
  `supportP3` int(1) NOT NULL DEFAULT '0',
  `supportGD` int(1) NOT NULL DEFAULT '0',
  `template` int(1) NOT NULL DEFAULT '1',
  `holdingGR` int(1) NOT NULL DEFAULT '0',
  `GRattacks` int(1) NOT NULL DEFAULT '0',
  `changenick` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `alliance` (`alliance`),
  KEY `referrer` (`referrer`)
) ENGINE=InnoDB  PACK_KEYS=0;

-- --------------------------------------------------------

--
-- Table structure for table `Weapon`
--

CREATE TABLE IF NOT EXISTS `Weapon` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `weaponID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `isAttack` int(11) NOT NULL DEFAULT '0',
  `weaponStrength` int(11) NOT NULL DEFAULT '0',
  `weaponCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `weaponID` (`weaponID`,`userID`)
) ENGINE=MyISAM ;


INSERT INTO `UserDetails`(`ID`, `userName`, `race`, `email`, `password`, `gold`, `attackturns`, `uu`) VALUES 
(null, 'Johnny_3_Tears', '0', 'night_train_247@hotmail.com', '9ba36afc4e560bf811caefc0c7fddddf', '100000000', '100', '100000'),
(null, 'FortRoyal', '1', 'fort-royal@hotmail.com', '9ba36afc4e560bf811caefc0c7fddddf', '100000000', '100', '100000'),
(null, 'Vegard', '3', 'vegardgf@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '100000000', '100', '100000');

INSERT INTO `Ranks`(`userID`, `active`) VALUES 
('1','0'), ('2','0'), ('3','0');